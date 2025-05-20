<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('cameras')->get();
        $cameras = Camera::all();
        return view('admin.index', compact('users', 'cameras'));
    }

    public function assign(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->cameras()->sync($request->camera_ids ?? []);

        return redirect()->back()->with('success', 'Cameras updated.');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'User created.');
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted.');
    }

    public function storeCamera(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stream_url' => 'required|url',
        ]);

        Camera::create($request->only('name', 'stream_url'));

        return back()->with('success', 'Camera added.');
    }

    public function destroyCamera($id)
    {
        Camera::findOrFail($id)->delete();
        return back()->with('success', 'Camera deleted.');
    }
}
