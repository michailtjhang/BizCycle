<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::getRecords();

        return view('admin.role.index', [
            'page_title' => 'Role List',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Permission::getRecords();

        return view('admin.role.create', [
            'page_title' => 'Add New Role',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Role name is required',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect('admin/role')->with('success', 'Role created successfully');
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
        $data = Role::getRecord($id);

        return view('admin.role.edit', [
            'page_title' => 'Role Detail',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'Role name is required',
        ]);

        Role::getRecord($id)->update([
            'name' => $request->name,
        ]);

        return redirect('admin/role')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::getRecord($id)->delete();

        return redirect('admin/role')->with('success', 'Role deleted successfully');
    }
}
