<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbRequirement;
use App\Models\Ppdb as PPDB;



class PPDBRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $ppdb = PPDB::latest()->first();
        $requirements = $ppdb 
    ? PpdbRequirement::where('pdr_ppdb_id', $ppdb->ppd_id)->get() 
    : collect();
        $ppdbList = PPDB::orderBy('ppd_created_at', 'desc')->get();
        // dd($requirements);
        // dd($requirements);
        return view('administration.ppdb_requirement.index',compact(['requirements','ppdb','ppdbList']));
    }

    public function getByPpdb($ppdbId)
    {
        $requirements = PpdbRequirement::where('pdr_ppdb_id', $ppdbId)->get();
        return response()->json($requirements);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($ppdbId)
    {
         $ppdb = PPDB::findOrFail($ppdbId);
    return view('administration.ppdb_requirement.create', compact('ppdb'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'pdr_name' => 'required|string|max:255',
        'pdr_type' => 'required|in:text,file,number,date',
        'pdr_ppdb_id' => 'required|exists:ppdbs,ppd_id',
    ]);

    PpdbRequirement::create([
        'pdr_name'    => $request->pdr_name,
        'pdr_type'    => $request->pdr_type,
        'pdr_ppdb_id' => $request->pdr_ppdb_id,
    ]);

    return redirect('/administration/ppdb-requirement/0')
        ->with('success', 'Persyaratan berhasil ditambahkan!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requirement = PpdbRequirement::findOrFail($id);
    $requirement->delete();

    return redirect()->back()
        ->with('success', 'Persyaratan berhasil dihapus!');
    }
}
