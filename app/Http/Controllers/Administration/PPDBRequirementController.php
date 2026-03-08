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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
