<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('teacher')
            ->orderByRaw("
                CASE day
                    WHEN 'Senin' THEN 1
                    WHEN 'Selasa' THEN 2
                    WHEN 'Rabu' THEN 3
                    WHEN 'Kamis' THEN 4
                    WHEN 'Jumat' THEN 5
                    WHEN 'Sabtu' THEN 6
                    WHEN 'Minggu' THEN 7
                END
            ")
            ->orderBy('start_time')
            ->get();

        return view(
            'admin.schedules.index',
            compact('schedules')
        );
    }


    public function create()
    {
        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.schedules.create',
            compact('teachers')
        );
    }


    /**
     * Cek bentrok jadwal.
     *
     * Yang dicek:
     * 1. Guru
     * 2. Kelas
     * 3. Ruangan
     */
    private function hasConflict(
        Request $request,
        ?Schedule $schedule = null
    ): ?string {

        /*
        |--------------------------------------------------------------------------
        | QUERY DASAR
        |--------------------------------------------------------------------------
        */

        $query = Schedule::query()
            ->where('day', $request->day)
            ->where('is_active', true)
            ->where(function ($query) use ($request) {

                /*
                |--------------------------------------------------------------------------
                | WAKTU BENTROK
                |--------------------------------------------------------------------------
                |
                | Contoh:
                |
                | Jadwal A : 08:00 - 09:00
                | Jadwal B : 08:30 - 09:30
                |
                | => bentrok
                |
                | Tetapi:
                |
                | Jadwal A : 08:00 - 09:00
                | Jadwal B : 09:00 - 10:00
                |
                | => tidak bentrok
                |
                */

                $query->where(
                    'start_time',
                    '<',
                    $request->end_time
                )->where(
                    'end_time',
                    '>',
                    $request->start_time
                );

            });


        /*
        |--------------------------------------------------------------------------
        | JIKA EDIT
        |--------------------------------------------------------------------------
        |
        | Jangan membandingkan jadwal dengan dirinya sendiri.
        |
        */

        if ($schedule) {

            $query->where(
                'id',
                '!=',
                $schedule->id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA JADWAL YANG BENTROK
        |--------------------------------------------------------------------------
        */

        $conflicts = $query
            ->with('teacher')
            ->get();


        if ($conflicts->isEmpty()) {

            return null;

        }


        /*
        |--------------------------------------------------------------------------
        | CEK SATU PER SATU
        |--------------------------------------------------------------------------
        */

        foreach ($conflicts as $conflict) {


            /*
            |--------------------------------------------------------------------------
            | 1. BENTROK GURU
            |--------------------------------------------------------------------------
            */

            if (
                $conflict->teacher_id ==
                $request->teacher_id
            ) {

                $teacherName =
                    optional($conflict->teacher)->name
                    ?? 'Guru tersebut';

                return
                    "Jadwal bentrok. {$teacherName} "
                    . "sudah mengajar pada hari {$conflict->day} "
                    . "pukul "
                    . date('H:i', strtotime($conflict->start_time))
                    . " - "
                    . date('H:i', strtotime($conflict->end_time))
                    . ".";
            }


            /*
            |--------------------------------------------------------------------------
            | 2. BENTROK KELAS
            |--------------------------------------------------------------------------
            */

            if (
                strcasecmp(
                    trim($conflict->class_name),
                    trim($request->class_name)
                ) === 0
            ) {

                return
                    "Jadwal bentrok. Kelas "
                    . $conflict->class_name
                    . " sudah memiliki mata pelajaran "
                    . "\""
                    . $conflict->subject
                    . "\" pada hari "
                    . $conflict->day
                    . " pukul "
                    . date('H:i', strtotime($conflict->start_time))
                    . " - "
                    . date('H:i', strtotime($conflict->end_time))
                    . ".";
            }


            /*
            |--------------------------------------------------------------------------
            | 3. BENTROK RUANGAN
            |--------------------------------------------------------------------------
            |
            | Ruangan kosong tidak perlu dianggap bentrok.
            |
            */

            if (
                filled($request->room) &&
                filled($conflict->room) &&
                strcasecmp(
                    trim($conflict->room),
                    trim($request->room)
                ) === 0
            ) {

                return
                    "Jadwal bentrok. Ruangan "
                    . $conflict->room
                    . " sedang digunakan untuk kelas "
                    . $conflict->class_name
                    . " pada hari "
                    . $conflict->day
                    . " pukul "
                    . date('H:i', strtotime($conflict->start_time))
                    . " - "
                    . date('H:i', strtotime($conflict->end_time))
                    . ".";
            }

        }


        return null;
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'teacher_id' => [
                'required',
                'exists:teachers,id',
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'class_name' => [
                'required',
                'string',
                'max:100',
            ],

            'day' => [
                'required',
                'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | CEK BENTROK
        |--------------------------------------------------------------------------
        */

        $conflict = $this->hasConflict(
            $request,
            null
        );


        if ($conflict) {

            return back()
                ->withInput()
                ->withErrors([
                    'schedule' => $conflict,
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        Schedule::create($validated);


        return redirect()
            ->route('admin.schedules.index')
            ->with(
                'success',
                'Jadwal mengajar berhasil ditambahkan.'
            );
    }


    public function show(Schedule $schedule)
    {
        return redirect()
            ->route(
                'admin.schedules.edit',
                $schedule
            );
    }


    public function edit(Schedule $schedule)
    {
        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.schedules.edit',
            compact(
                'schedule',
                'teachers'
            )
        );
    }


    public function update(
        Request $request,
        Schedule $schedule
    ) {

        $validated = $request->validate([

            'teacher_id' => [
                'required',
                'exists:teachers,id',
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'class_name' => [
                'required',
                'string',
                'max:100',
            ],

            'day' => [
                'required',
                'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | CEK BENTROK
        |--------------------------------------------------------------------------
        */

        $conflict = $this->hasConflict(
            $request,
            $schedule
        );


        if ($conflict) {

            return back()
                ->withInput()
                ->withErrors([
                    'schedule' => $conflict,
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $schedule->update($validated);


        return redirect()
            ->route('admin.schedules.index')
            ->with(
                'success',
                'Jadwal mengajar berhasil diperbarui.'
            );
    }


    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('admin.schedules.index')
            ->with(
                'success',
                'Jadwal mengajar berhasil dihapus.'
            );
    }
}