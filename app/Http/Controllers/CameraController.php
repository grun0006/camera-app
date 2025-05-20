<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camera;
use Illuminate\Support\Facades\Auth;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Auth::user()->cameras;
        return view('index', compact('cameras'));
    }
}
