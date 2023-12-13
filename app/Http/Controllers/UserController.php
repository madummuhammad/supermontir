<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $profile = auth()->user();
        return Inertia::render('User/Index', [
            'profile' => $profile,
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'wa' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $validatedData['image'] = $request->image;

        $userId = Auth::id();
        User::where('id', $userId)->update($validatedData);

        return back()->with('message', ['status' => 'success', 'message' => 'Success! Profile berhasil di ubah']);
    }

    public function upload(Request $request)
    {
        $image = $request->file('image')->store('public/image');
        $url = url('/') . '/' . str_replace('public/', "storage/", $image);

        return response()->json(['status' => 'success', 'data' => $url]);
    }
}