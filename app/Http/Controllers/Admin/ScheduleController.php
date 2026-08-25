<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | CEK BENTROK JADWAL
    |--------------------------------------------------------------------------
    |
    | Aturan:
    |
    | 1. Guru tidak boleh mengajar 2 mapel
    |    pada waktu yang sama.
    |
    | 2. Kelas tidak boleh memiliki 2 mapel
    |    pada waktu yang sama.
    |
    | 3. Hanya jadwal aktif yang diperiksa.
    |
    | 4. Saat edit, jadwal yang sedang diedit
    |    tidak dihitung sebagai bentrok.
    |
    */

    private function hasConflict(
        Request $request,
        ?Schedule $schedule = null
    ): ?string {

        $query = Schedule::query()

            // Hari harus sama
            ->where(
                'day',
                $request->day
            )

            // Hanya jadwal aktif
            ->where(
                'is_active',
                true
            )

            /*
            |--------------------------------------------------------------------------
            | CEK WAKTU BENTROK
            |--------------------------------------------------------------------------
            |
            | Jadwal bentrok apabila:
            |
            | jadwal_lama.mulai < jadwal_baru.selesai
            |
            | DAN
            |
            | jadwal_lama.selesai > jadwal_baru.mulai
            |
            */

            ->where(function ($query) use ($request) {

                /*
                |--------------------------------------------------------------------------
                | BENTROK GURU
                |--------------------------------------------------------------------------
                */

                $query->where(function ($query) use ($request) {

                    $query
                        ->where(
                            'teacher_id',
                            $request->teacher_id
                        )

                        ->where(
                            'start_time',
                            '<',
                            $request->end_time
                        )

                        ->where(
                            'end_time',
                            '>',
                            $request->start_time
                        );

                })


                /*
                |--------------------------------------------------------------------------
                | ATAU BENTROK KELAS
                |--------------------------------------------------------------------------
                */

                ->orWhere(function ($query) use ($request) {

                    $query
                        ->where(
                            'class_name',
                            $request->class_name
                        )

                        ->where(
                            'start_time',
                            '<',
                            $request->end_time
                        )

                        ->where(
                            'end_time',
                            '>',
                            $request->start_time
                        );

                });

            });


        /*
        |--------------------------------------------------------------------------
        | EDIT
        |--------------------------------------------------------------------------
        |
        | Jangan anggap jadwal yang sedang diedit
        | sebagai jadwal bentrok dengan dirinya sendiri.
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
        | CARI JADWAL BENTROK
        |--------------------------------------------------------------------------
        */

        $conflict = $query
            ->with('teacher')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA BENTROK
        |--------------------------------------------------------------------------
        */

        if (!$conflict) {

            return null;

        }


        /*
        |--------------------------------------------------------------------------
        | GURU DAN KELAS SAMA-SAMA BENTROK
        |--------------------------------------------------------------------------
        */

        if (
            $conflict->teacher_id == $request->teacher_id
            &&
            $conflict->class_name == $request->class_name
        ) {

            return
                "Jadwal bentrok: guru dan kelas sudah memiliki jadwal pada waktu tersebut.";

        }


        /*
        |--------------------------------------------------------------------------
        | GURU BENTROK
        |--------------------------------------------------------------------------
        */

        if (
            $conflict->teacher_id == $request->teacher_id
        ) {

            return
                "Jadwal bentrok: {$conflict->teacher->name} masih mengajar pada waktu tersebut.";

        }


        /*
        |--------------------------------------------------------------------------
        | KELAS BENTROK
        |--------------------------------------------------------------------------
        */

        if (
            $conflict->class_name == $request->class_name
        ) {

            return
                "Jadwal bentrok: kelas {$conflict->class_name} sudah memiliki mata pelajaran pada waktu tersebut.";

        }


        /*
        |--------------------------------------------------------------------------
        | FALLBACK
        |--------------------------------------------------------------------------
        */

        return
            "Jadwal bentrok dengan jadwal yang sudah ada.";
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

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
        | CEK BENTROK
        |--------------------------------------------------------------------------
        */

        $conflict = $this->hasConflict(
            $request
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
        | STATUS
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        Schedule::create(
            $validated
        );


        return redirect()
            ->route(
                'admin.schedules.index'
            )
            ->with(
                'success',
                'Jadwal mengajar berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Schedule $schedule
    ) {

        return redirect()
            ->route(
                'admin.schedules.edit',
                $schedule
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Schedule $schedule
    ) {

        $teachers = Teacher::query()
            ->where(
                'is_active',
                true
            )
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


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

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
        | CEK BENTROK
        |--------------------------------------------------------------------------
        |
        | Kirim $schedule supaya jadwal yang sedang
        | diedit tidak dianggap bentrok dengan dirinya sendiri.
        |
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
        | STATUS
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $schedule->update(
            $validated
        );


        return redirect()
            ->route(
                'admin.schedules.index'
            )
            ->with(
                'success',
                'Jadwal mengajar berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Schedule $schedule
    ) {

        $schedule->delete();


        return redirect()
            ->route(
                'admin.schedules.index'
            )
            ->with(
                'success',
                'Jadwal mengajar berhasil dihapus.'
            );
    }
}