<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Academic_Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();
        $academic_year = Academic_Year::all();
        foreach ($academic_year  as $year) {

            $start = Carbon::create($year->acy_year, 7, 1);
            $end   = Carbon::create($year->acy_year + 1, 6, 30);
    
            if ($now->between($start, $end)) {
                $year->acy_status = 1;
            } else {
                $year->acy_status = 0;
            }
    
            $year->save();
        }
    
        $academicYears = Academic_Year::latest()->get();
        $title = 'Hapus Tahun Akademik!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('administration.academic_year.index', compact('academic_year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.academic_year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'acy_year' => 'required|digits:4|integer'
        ]);
    
        Academic_Year::create([
            'acy_year' => $request->acy_year,
            'acy_created_by' => auth()->id()
        ]);
    
        Alert::success('Berhasil Menambah', 'Berhasil menambah data tahun ajaran');
        return redirect('/administration/academic_years');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_academic = Academic_Year::findOrFail($id);
        return view('administration.academic_year.edit', compact('edit_academic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'acy_year' => 'required|digits:4|integer'
        ]);
    
        $academicYear = Academic_Year::findOrFail($id);
    
        $academicYear->update([
            'acy_year' => $request->acy_year,
            'acy_updated_by' => auth()->id()
        ]);
    
        Alert::success('Berhasil Update', 'Data tahun ajaran berhasil diperbarui');
        return redirect('/administration/academic_years');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyAcademic = Academic_Year::findOrFail($id);

    // Cek status
    if ($destroyAcademic->acy_status == 1) {

        Alert::error('Gagal', 'Tahun ajaran masih aktif');
        return redirect('/administration/academic_years');
    }

    // Kalau status 0 → boleh hapus
    $destroyAcademic->delete();

    Alert::success('Berhasil', 'Tahun ajaran berhasil dihapus');

    return redirect('/administration/academic_years');
    }
}
