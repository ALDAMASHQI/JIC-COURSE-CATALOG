<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::with('department')->paginate(12);
        return view('majors.index', compact('majors'));
    }

    public function show($id)
    {
        $major = Major::with(['department', 'courses'])->findOrFail($id);
        return view('majors.show', compact('major'));
    }
}
