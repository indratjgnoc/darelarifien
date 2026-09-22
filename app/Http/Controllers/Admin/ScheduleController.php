<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\TeacherClassSubject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Menampilkan daftar jadwal.
     */
    public function index()
    {
        $schedules = Schedule::with([
            'teacherClassSubject.academicYear',
            'teacherClassSubject.schoolClass',
            'teacherClassSubject.teacher',
            'teacherClassSubject.subject',
            'teacher',
        ])
            ->orderByRaw("
                CASE day
                    WHEN 'Senin' THEN 1
                    WHEN 'Selasa' THEN 2
                    WHEN 'Rabu' THEN 3
                    WHEN 'Kamis' THEN 4
                    WHEN 'Jumat' THEN 5
                    WHEN 'Sabtu' THEN 6
                    WHEN 'Minggu' THEN 7
                    ELSE 8
                END
            ")
            ->orderBy('start_time')
            ->get();

        return view(
            'admin.schedules.index',
            compact('schedules')
        );
    }


    /**
     * Form tambah jadwal.
     */
    public function create()
    {
        $teacherClassSubjects = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'teacher',
            'subject',
        ])
            ->where('is_active', true)
            ->get()
            ->sortBy(function ($assignment) {
                return [
                    $assignment->schoolClass?->name ?? '',
                    $assignment->subject?->name ?? '',
                    $assignment->teacher?->name ?? '',
                ];
            });

        return view(
            'admin.schedules.create',
            compact('teacherClassSubjects')
        );
    }


    /**
     * Mengecek bentrok jadwal.
     *
     * Bentrok yang dicek:
     * 1. Guru
     * 2. Kelas
     * 3. Ruangan
     */
    private function hasConflict(
        TeacherClassSubject $assignment,
        string $day,
        string $startTime,
        string $endTime,
        ?string $room = null,
        ?int $scheduleId = null
    ): ?string {

        /*
        |--------------------------------------------------------------------------
        | Ambil jadwal yang waktunya bertabrakan
        |--------------------------------------------------------------------------
        */

        $query = Schedule::query()
            ->where('day', $day)
            ->where('is_active', true)
            ->where(function ($query) use ($startTime, $endTime) {
                $query
                    ->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            });

        /*
        |--------------------------------------------------------------------------
        | Saat UPDATE, jangan membandingkan jadwal dengan dirinya sendiri
        |--------------------------------------------------------------------------
        */

        if ($scheduleId) {
            $query->where('id', '!=', $scheduleId);
        }

        $existingSchedules = $query
            ->with([
                'teacherClassSubject',
                'teacherClassSubject.academicYear',
                'teacherClassSubject.schoolClass',
                'teacherClassSubject.teacher',
                'teacherClassSubject.subject',
            ])
            ->get();


        foreach ($existingSchedules as $schedule) {

            /*
            |--------------------------------------------------------------------------
            | 1. CEK BENTROK GURU
            |--------------------------------------------------------------------------
            */

            if ($schedule->teacher_class_subject_id) {

                $existingAssignment = $schedule->teacherClassSubject;

                if (
                    $existingAssignment &&
                    $existingAssignment->teacher_id === $assignment->teacher_id &&
                    $existingAssignment->academic_year_id === $assignment->academic_year_id
                ) {
                    return 'Guru tersebut sudah memiliki jadwal pada waktu yang sama.';
                }

            } elseif (
                $schedule->teacher_id &&
                $schedule->teacher_id === $assignment->teacher_id
            ) {

                /*
                |--------------------------------------------------------------------------
                | Fallback untuk jadwal lama
                |--------------------------------------------------------------------------
                */

                return 'Guru tersebut sudah memiliki jadwal pada waktu yang sama.';
            }


            /*
            |--------------------------------------------------------------------------
            | 2. CEK BENTROK KELAS
            |--------------------------------------------------------------------------
            */

            if ($schedule->teacher_class_subject_id) {

                $existingAssignment = $schedule->teacherClassSubject;

                if (
                    $existingAssignment &&
                    $existingAssignment->school_class_id === $assignment->school_class_id &&
                    $existingAssignment->academic_year_id === $assignment->academic_year_id
                ) {
                    return 'Kelas tersebut sudah memiliki jadwal pada waktu yang sama.';
                }

            } elseif (
                $schedule->class_name &&
                $schedule->class_name === $assignment->schoolClass?->name
            ) {

                /*
                |--------------------------------------------------------------------------
                | Fallback untuk jadwal lama
                |--------------------------------------------------------------------------
                */

                return 'Kelas tersebut sudah memiliki jadwal pada waktu yang sama.';
            }


            /*
            |--------------------------------------------------------------------------
            | 3. CEK BENTROK RUANGAN
            |--------------------------------------------------------------------------
            */

            if (
                $room &&
                $schedule->room &&
                strcasecmp(
                    trim($schedule->room),
                    trim($room)
                ) === 0
            ) {
                return 'Ruangan tersebut sudah digunakan pada waktu yang sama.';
            }
        }

        return null;
    }


    /**
     * Menyimpan jadwal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_class_subject_id' => [
                'required',
                'exists:teacher_class_subjects,id',
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
        | Ambil penugasan mengajar
        |--------------------------------------------------------------------------
        */

        $assignment = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'teacher',
            'subject',
        ])->findOrFail(
            $validated['teacher_class_subject_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Pastikan penugasan masih aktif
        |--------------------------------------------------------------------------
        */

        if (!$assignment->is_active) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_class_subject_id' =>
                        'Penugasan mengajar tersebut tidak aktif.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK BENTROK
        |--------------------------------------------------------------------------
        */

        $conflict = $this->hasConflict(
            $assignment,
            $validated['day'],
            $validated['start_time'],
            $validated['end_time'],
            $validated['room'] ?? null
        );


        if ($conflict) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_class_subject_id' => $conflict,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Isi kolom legacy
        |--------------------------------------------------------------------------
        |
        | Kolom ini sementara tetap diisi agar data lama tetap kompatibel.
        |
        */

        $validated['teacher_id'] = $assignment->teacher_id;

        $validated['subject'] = $assignment->subject?->name;

        $validated['class_name'] = $assignment->schoolClass?->name;

        $validated['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        Schedule::create($validated);


        return redirect()
            ->route('admin.schedules.index')
            ->with(
                'success',
                'Jadwal berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail.
     *
     * Untuk saat ini diarahkan ke halaman edit.
     */
    public function show(Schedule $schedule)
    {
        return redirect()
            ->route(
                'admin.schedules.edit',
                $schedule
            );
    }


    /**
     * Form edit jadwal.
     */
    public function edit(Schedule $schedule)
    {
        /*
        |--------------------------------------------------------------------------
        | Load relasi jadwal
        |--------------------------------------------------------------------------
        */

        $schedule->load([
            'teacherClassSubject.academicYear',
            'teacherClassSubject.schoolClass',
            'teacherClassSubject.teacher',
            'teacherClassSubject.subject',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil semua penugasan mengajar aktif
        |--------------------------------------------------------------------------
        */

        $teacherClassSubjects = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'teacher',
            'subject',
        ])
            ->where('is_active', true)
            ->get()
            ->sortBy(function ($assignment) {
                return [
                    $assignment->schoolClass?->name ?? '',
                    $assignment->subject?->name ?? '',
                    $assignment->teacher?->name ?? '',
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | Jika penugasan jadwal saat ini sudah tidak aktif,
        | tetap masukkan ke pilihan agar data tidak hilang.
        |--------------------------------------------------------------------------
        */

        if (
            $schedule->teacherClassSubject &&
            !$schedule->teacherClassSubject->is_active
        ) {

            $exists = $teacherClassSubjects->contains(
                'id',
                $schedule->teacherClassSubject->id
            );

            if (!$exists) {
                $teacherClassSubjects->push(
                    $schedule->teacherClassSubject
                );
            }
        }


        return view(
            'admin.schedules.edit',
            compact(
                'schedule',
                'teacherClassSubjects'
            )
        );
    }


    /**
     * Memperbarui jadwal.
     */
    public function update(
        Request $request,
        Schedule $schedule
    ) {

        $validated = $request->validate([
            'teacher_class_subject_id' => [
                'required',
                'exists:teacher_class_subjects,id',
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
        | Ambil penugasan mengajar
        |--------------------------------------------------------------------------
        */

        $assignment = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'teacher',
            'subject',
        ])->findOrFail(
            $validated['teacher_class_subject_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Pastikan penugasan aktif
        |--------------------------------------------------------------------------
        */

        if (!$assignment->is_active) {

            /*
            | Jika assignment yang dipilih berbeda dari assignment lama
            | dan sudah tidak aktif, tolak.
            */

            if (
                !$schedule->teacher_class_subject_id ||
                (int) $schedule->teacher_class_subject_id !==
                (int) $assignment->id
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'teacher_class_subject_id' =>
                            'Penugasan mengajar tersebut tidak aktif.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CEK BENTROK
        |--------------------------------------------------------------------------
        */

        $conflict = $this->hasConflict(
            $assignment,
            $validated['day'],
            $validated['start_time'],
            $validated['end_time'],
            $validated['room'] ?? null,
            $schedule->id
        );


        if ($conflict) {

            return back()
                ->withInput()
                ->withErrors([
                    'teacher_class_subject_id' => $conflict,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update kolom legacy
        |--------------------------------------------------------------------------
        */

        $validated['teacher_id'] = $assignment->teacher_id;

        $validated['subject'] = $assignment->subject?->name;

        $validated['class_name'] = $assignment->schoolClass?->name;

        $validated['is_active'] = $request->boolean('is_active');


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


    /**
     * Menghapus jadwal.
     */
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