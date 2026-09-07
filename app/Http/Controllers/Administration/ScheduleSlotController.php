<?php

namespace App\Http\Controllers\administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleSlot;
use RealRashid\SweetAlert\Facades\Alert;


class ScheduleSlotController extends Controller
{
    public function index()
    {
        $title = 'Hapus Slot jadwal!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        $scheduleSlots = ScheduleSlot::orderBy('slt_day')
        ->orderBy('slt_start_time')
        ->get();
        return view(
            'administration.schedule.slot.index',
            compact('scheduleSlots')
        );
    }

    public function create()
    {
        return view('administration.schedule.slot.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slt_day' => 'required|integer|in:1,2,3,4,5',
            'slt_number' => 'nullable|integer|min:1',
            'slt_start_time' => 'required|date_format:H:i',
            'slt_end_time' => 'required|date_format:H:i|after:slt_start_time',
            'slt_type' => 'required|in:lesson,break',
        ], [
            'slt_day.required' => 'Hari wajib dipilih.',
            'slt_day.in' => 'Hari yang dipilih tidak valid.',

            'slt_number.integer' => 'Nomor jam harus berupa angka.',
            'slt_number.min' => 'Nomor jam minimal 1.',

            'slt_start_time.required' => 'Jam mulai wajib diisi.',
            'slt_start_time.date_format' => 'Format jam mulai tidak valid.',

            'slt_end_time.required' => 'Jam selesai wajib diisi.',
            'slt_end_time.date_format' => 'Format jam selesai tidak valid.',
            'slt_end_time.after' => 'Jam selesai harus setelah jam mulai.',

            'slt_type.required' => 'Tipe slot wajib dipilih.',
            'slt_type.in' => 'Tipe slot tidak valid.',
        ]);

        if ($validated['slt_type'] === 'lesson') {

            $numberExists = ScheduleSlot::where('slt_day', $validated['slt_day'])
                ->where('slt_number', $validated['slt_number'])
                ->exists();

            if ($numberExists) {
                Alert::error(
                    'Gagal',
                    'Nomor jam tersebut sudah digunakan pada hari yang dipilih.'
                );

                return redirect()->back()->withInput();
            }
        }

        // Jika break, nomor jam tidak perlu disimpan
        if ($validated['slt_type'] === 'break') {
            $validated['slt_number'] = null;
        }

        // Cek apakah waktu bertabrakan dengan slot lain
        $overlap = ScheduleSlot::where('slt_day', $validated['slt_day'])
            ->where(function ($query) use ($validated) {
                $query->where('slt_start_time', '<', $validated['slt_end_time'])
                    ->where('slt_end_time', '>', $validated['slt_start_time']);
            })
            ->exists();

        if ($overlap) {
            Alert::error(
                'Gagal',
                'Waktu yang dipilih bertabrakan dengan slot yang sudah ada.'
            );

            return redirect()->back()->withInput();
        }

        ScheduleSlot::create([
            'slt_day' => $validated['slt_day'],
            'slt_number' => $validated['slt_number'],
            'slt_start_time' => $validated['slt_start_time'],
            'slt_end_time' => $validated['slt_end_time'],
            'slt_type' => $validated['slt_type'],
            'slt_created_by' => auth()->id(),
        ]);

        Alert::success(
            'Berhasil',
            'Slot jadwal berhasil ditambahkan.'
        );

        return redirect()->route('administration.schedule.slot.index');
    }

    public function edit($id)
    {
        $scheduleSlot = ScheduleSlot::findOrFail($id);

        return view(
            'administration.schedule.slot.edit',
            compact('scheduleSlot')
        );
    }
    public function update(Request $request, $id)
    {
        $scheduleSlot = ScheduleSlot::findOrFail($id);

        $validated = $request->validate([
            'slt_day' => 'required|integer|in:1,2,3,4,5',
            'slt_number' => 'nullable|integer|min:1',
            'slt_start_time' => 'required|date_format:H:i',
            'slt_end_time' => 'required|date_format:H:i|after:slt_start_time',
            'slt_type' => 'required|in:lesson,break',
        ], [
            'slt_day.required' => 'Hari wajib dipilih.',
            'slt_day.in' => 'Hari yang dipilih tidak valid.',

            'slt_number.integer' => 'Nomor jam harus berupa angka.',
            'slt_number.min' => 'Nomor jam minimal 1.',

            'slt_start_time.required' => 'Jam mulai wajib diisi.',
            'slt_start_time.date_format' => 'Format jam mulai tidak valid.',

            'slt_end_time.required' => 'Jam selesai wajib diisi.',
            'slt_end_time.date_format' => 'Format jam selesai tidak valid.',
            'slt_end_time.after' => 'Jam selesai harus setelah jam mulai.',

            'slt_type.required' => 'Tipe slot wajib dipilih.',
            'slt_type.in' => 'Tipe slot tidak valid.',
        ]);

        if ($validated['slt_type'] === 'lesson') {

            if (empty($validated['slt_number'])) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'slt_number' => 'Nomor jam wajib diisi untuk slot pelajaran.'
                    ]);
            }

            $numberExists = ScheduleSlot::where('slt_day', $validated['slt_day'])
                ->where('slt_number', $validated['slt_number'])
                ->where('slt_id', '!=', $scheduleSlot->slt_id)
                ->exists();

            if ($numberExists) {
                Alert::error(
                    'Gagal',
                    'Nomor jam tersebut sudah digunakan pada hari yang dipilih.'
                );

                return redirect()->back()->withInput();
            }
        } else {
            $validated['slt_number'] = null;
        }

        $overlap = ScheduleSlot::where('slt_day', $validated['slt_day'])
            ->where('slt_id', '!=', $scheduleSlot->slt_id)
            ->where(function ($query) use ($validated) {
                $query->where('slt_start_time', '<', $validated['slt_end_time'])
                    ->where('slt_end_time', '>', $validated['slt_start_time']);
            })
            ->exists();

        if ($overlap) {
            Alert::error(
                'Gagal',
                'Waktu yang dipilih bertabrakan dengan slot yang sudah ada.'
            );

            return redirect()->back()->withInput();
        }

        $scheduleSlot->update([
            'slt_day' => $validated['slt_day'],
            'slt_number' => $validated['slt_number'],
            'slt_start_time' => $validated['slt_start_time'],
            'slt_end_time' => $validated['slt_end_time'],
            'slt_type' => $validated['slt_type'],
            'slt_updated_by' => auth()->id(),
        ]);

        Alert::success(
            'Berhasil',
            'Slot jadwal berhasil diperbarui.'
        );

        return redirect()->route(
            'administration.schedule.slot.index'
        );
    }

    public function destroy($id)
    {
        $scheduleSlot = ScheduleSlot::findOrFail($id);

        $scheduleSlot->update([
            'slt_deleted_by' => auth()->id(),
        ]);

        $scheduleSlot->delete();

        Alert::success(
            'Berhasil',
            'Slot jadwal berhasil dihapus.'
        );

        return redirect()->route(
            'administration.schedule.slot.index'
        );
    }
}
