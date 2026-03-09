<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Academic_Year;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PPDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppdb = Ppdb::all();
        $academic = Academic_Year::all();
        $title = 'Hapus Data PPDB!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('administration.ppdb.index', compact(['ppdb', 'academic']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academic = Academic_Year::where('acy_status', 0)->get();
        return view('administration.ppdb.create', compact(['academic']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkYear = Ppdb::where('ppd_academic_id', $request->ppd_academic_id)->exists();

    if ($checkYear) {
        Alert::error('Gagal', 'PPDB untuk tahun ajaran ini sudah ada');
        return back()->withInput();
    }
    $academic = Academic_Year::find($request->ppd_academic_id);

$startAcademic = $academic->acy_year . '-07-01';
$endAcademic = ($academic->acy_year + 1) . '-06-30';

if ($request->ppd_start_date < $startAcademic || $request->ppd_start_date > $endAcademic) {
    Alert::error('Gagal', 'Tanggal mulai harus sesuai dengan tahun ajaran');
    return back()->withInput();
}

if ($request->ppd_end_date < $startAcademic || $request->ppd_end_date > $endAcademic) {
    Alert::error('Gagal', 'Tanggal berakhir harus sesuai dengan tahun ajaran');
    return back()->withInput();
}

        if ($request->ppd_end_date < $request->ppd_start_date) {
            Alert::error('Gagal', 'Tanggal berakhir tidak boleh sebelum tanggal mulai');
            return back()->withInput();
        }
        // dd($request->all());
        $fee = str_replace(['Rp', '.', ' '], '', $request->ppd_entry_fee);
        $create_ppdb = Ppdb::create([
            'ppd_academic_id' => $request->ppd_academic_id,
            'ppd_start_date' => $request->ppd_start_date,
            'ppd_end_date' => $request->ppd_end_date,
            'ppd_end_date' => $request->ppd_end_date,
            'ppd_entry_fee' => $fee,

        ]); 
        // dd($create_ppdb);
        Alert::success('Berhasil Menambah', 'Berhasil menambah data jurusan');
        return redirect('/administration/ppdb');
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
        $edit_ppdb = Ppdb::findOrFail($id);
        $academic = Academic_Year::all();
        return view('administration.ppdb.edit', compact(['edit_ppdb', 'academic']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $checkYear = Ppdb::where('ppd_academic_id', $request->ppd_academic_id)->exists();

        if ($checkYear) {
            Alert::error('Gagal', 'PPDB untuk tahun ajaran ini sudah ada');
            return back()->withInput();
        }
        $academic = Academic_Year::find($request->ppd_academic_id);

$startAcademic = $academic->acy_year . '-07-01';
$endAcademic = ($academic->acy_year + 1) . '-06-30';

if ($request->ppd_start_date < $startAcademic || $request->ppd_start_date > $endAcademic) {
    Alert::error('Gagal', 'Tanggal mulai harus sesuai dengan tahun ajaran');
    return back()->withInput();
}

if ($request->ppd_end_date < $startAcademic || $request->ppd_end_date > $endAcademic) {
    Alert::error('Gagal', 'Tanggal berakhir harus sesuai dengan tahun ajaran');
    return back()->withInput();
}
    
        if ($request->ppd_end_date < $request->ppd_start_date) {
            Alert::error('Gagal', 'Tanggal berakhir tidak boleh sebelum tanggal mulai');
            return back()->withInput();
        }
        //  dd($request->all());
        $fee = str_replace(['Rp', '.', ' '], '', $request->ppd_entry_fee);
        $update_Ppdb =Ppdb::findOrFail($id); 
        $update_Ppdb->ppd_academic_id= $request->ppd_academic_id;
        $update_Ppdb->ppd_start_date = $request->ppd_start_date;
        $update_Ppdb->ppd_end_date = $request->ppd_end_date;
        $update_Ppdb->ppd_end_date = $request->ppd_end_date;
        $update_Ppdb->ppd_entry_fee = $fee;
        $update_Ppdb->save();

        Alert::success('Berhasil Mengedit', 'Berhasil mengubah data jurusan');
        return redirect('/administration/ppdb');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy_ppdb = Ppdb::findOrFail($id);
        //dd ($destroyScopeCategories);
        $destroy_ppdb->delete();
        Alert::success('Berhasil Menghapus', 'Berhasil menghapus data ppdb');
        return redirect('/administration/ppdb');
    }
}
