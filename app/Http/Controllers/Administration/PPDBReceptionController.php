<?php

namespace App\Http\Controllers\administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppdb;
use App\Models\PpdbSubmission;
use App\Models\PpdbRequirement;


class PPDBReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppdbList = Ppdb::orderByDesc('ppd_id')->get();
        $ppdb = $ppdbList->first();

        $participants = $ppdb
            ? PpdbSubmission::with(['student', 'major'])
                ->where('ppsu_ppdb_id', $ppdb->ppd_id)
                ->get()
            : collect();

        return view('administration.ppdb_reception.index', compact('ppdbList', 'ppdb', 'participants'));
    }
   public function list($ppdbId)
{
    $participants = PpdbSubmission::with(['student.user', 'major'])
        ->where('ppsu_ppdb_id', $ppdbId)
        ->get()
        ->map(function ($item) {
            return [
                'id'     => $item->ppsu_id,
                'name'   => $item->student->user->usr_name ?? '-',
                'major'  => $item->major->mjr_name ?? '-',
                'status' => $item->ppsu_status,
            ];
        });

    return response()->json($participants);
}

    public function accepted(){
        $ppdbList = Ppdb::orderByDesc('ppd_id')->get();
        $ppdb = $ppdbList->first();

        $participants = $ppdb
            ? PpdbSubmission::with(['student', 'major'])
                ->where('ppsu_ppdb_id', $ppdb->ppd_id)
                ->where('ppsu_status','1')
                ->get()
            : collect();

        return view('administration.ppdb_reception.accepted', compact('ppdbList', 'ppdb', 'participants'));
    }
    public function acceptedList($ppdbId)
{
    $participants = PpdbSubmission::with(['student.user', 'major'])
        ->where('ppsu_ppdb_id', $ppdbId)
        ->where('ppsu_status','1')
        ->get()
        ->map(function ($item) {
            return [
                'id'     => $item->ppsu_id,
                'name'   => $item->student->user->usr_name ?? '-',
                'major'  => $item->major->mjr_name ?? '-',
                'status' => $item->ppsu_status,
            ];
        });

    return response()->json($participants);
}

public function rejected(){
        $ppdbList = Ppdb::orderByDesc('ppd_id')->get();
        $ppdb = $ppdbList->first();
        // dd($ppdb);

        $participants = $ppdb
            ? PpdbSubmission::with(['student', 'major'])
                ->where('ppsu_ppdb_id', $ppdb->ppd_id)
                ->where('ppsu_status','2')
                ->get()
            : collect();

        return view('administration.ppdb_reception.rejected', compact('ppdbList', 'ppdb', 'participants'));
    }
    public function rejectedList($ppdbId)
{
    $participants = PpdbSubmission::with(['student.user', 'major'])
        ->where('ppsu_ppdb_id', $ppdbId)
        ->where('ppsu_status','2')
        ->get()
        ->map(function ($item) {
            return [
                'id'     => $item->ppsu_id,
                'name'   => $item->student->user->usr_name ?? '-',
                'major'  => $item->major->mjr_name ?? '-',
                'status' => $item->ppsu_status,
            ];
        });

    return response()->json($participants);
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
         $student   = PpdbSubmission::where('ppsu_student_id',$id)->first();
         $documents = PpdbRequirement::with(['upload' => fn($q) => $q->where('std_id', $id)])
                    ->where('pdr_ppdb_id', $student->ppd_id)
                    ->get()
                    ->map(function ($req) {
                        $req->file_path = $req->upload->file_path ?? null;
                        return $req;
                    });
        return view('administration.ppdb_reception.show', compact('student', 'documents'));
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
