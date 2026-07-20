<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('teacher.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updatePhoto(Request $request)
{
    $request->validate([
        'image' => 'required'
    ]);

    $image = preg_replace(
        '#^data:image/\w+;base64,#i',
        '',
        $request->image
    );

    $image = str_replace(' ', '+', $image);

    $filename = Str::uuid() . '.png';

    Storage::disk('public')->put(
        'profile/' . $filename,
        base64_decode($image)
    );

    $user = Auth::user();

    // hapus foto lama
    if ($user->usr_photo && Storage::disk('public')->exists($user->usr_photo)) {
        Storage::disk('public')->delete($user->usr_photo);
    }

    // simpan path baru
    $user->usr_photo = 'profile/' . $filename;
    $user->save();

    return response()->json([
        'success' => true,
        'image' => asset('storage/profile/' . $filename)
    ]);

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
