<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::withCount('majors')
            ->with('majors');

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Dept_Name', 'like', "%{$search}%");
            });
        }

        // Sort options
        $sort = $request->get('sort', 'name');
        switch ($sort) {
            case 'majors':
                $query->orderBy('majors_count', 'desc');
                break;
            case 'newest':
                $query->orderBy('Dept_ID', 'desc');
                break;
            case 'oldest':
                $query->orderBy('Dept_ID', 'asc');
                break;
            default:
                $query->orderBy('Dept_Name');
                break;
        }

        $departments = $query->paginate(10);

        return view('admin.departments', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Dept_Name' => 'required|string|max:100|unique:department,Dept_Name',
        ]);

        Department::create([
            'Dept_Name' => $request->Dept_Name,
        ]);

        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully!');
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            'Dept_Name' => 'required|string|max:100|unique:department,Dept_Name,' . $id . ',Dept_ID',
        ]);

        $department->update([
            'Dept_Name' => $request->Dept_Name,
        ]);

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully!');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        // Check if department has majors
        if ($department->majors()->count() > 0) {
            return redirect()->route('admin.departments.index')->with('error', 'Cannot delete department that has majors. Please reassign or delete the majors first.');
        }

        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully!');
    }
}
