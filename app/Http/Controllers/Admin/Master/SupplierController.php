<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PermissionRole = PermissionRole::getPermission('Supplier', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        $data['PermissionShow'] = PermissionRole::getPermission('Show Supplier', Auth::user()->role_id);

        $data['supplier'] = User::getSupplierById();
        return view('admin.master.supplier.index', [
            'data' => $data,
            'page_title' => 'Supplier List',
        ]);
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
        $data = Product::where('id_user', $id)->get();

        return view('admin.master.supplier.show', [
            'data' => $data,
            'page_title' => 'Product Supplier List',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
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