<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportingController extends Controller
{
    public function index()
    {
        $PermissionRole = PermissionRole::getPermission('Reporting', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }
        
        if (Auth::user()->role->name == 'Admin') {
            $product = Product::get();
        } else {
            $product = Product::where('id_user', Auth::user()->id_user)->get();
        }
        
        return view('admin.reporting.index', [
            'page_title' => 'Reporting',
            'product' => $product
        ]);
    }

    public function getAllDataProduct()
    {
        $PermissionRole = PermissionRole::getPermission('Reporting', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        if (Auth::user()->role->name == 'Admin') {
            $product = Product::get();
        } else {
            $product = Product::where('id_user', Auth::user()->id_user)->get();
        }
        for ($i = 0; $i < count($product); $i++) {
            if ($product[$i]['harga_satuan'] < 10000) {
                $product[$i]['price_range'] = 'less_10000';
            } elseif ($product[$i]['harga_satuan'] >= 10000 && $product[$i]['harga_satuan'] < 20000) {
                $product[$i]['price_range'] = '10000_20000';
            } elseif ($product[$i]['harga_satuan'] >= 20000 && $product[$i]['harga_satuan'] < 50000) {
                $product[$i]['price_range'] = '20000_50000';
            } elseif ($product[$i]['harga_satuan'] >= 50000 && $product[$i]['harga_satuan'] < 100000) {
                $product[$i]['price_range'] = '50000_100000';
            } else {
                $product[$i]['price_range'] = 'more_100000';
            }

            $product[$i]['created_range'] = $product[$i]['created_at']->format('Y-m');
        }

        return response()->json($product);
    }

    public function getChartProduct()
    {
        $PermissionRole = PermissionRole::getPermission('Reporting', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        if (Auth::user()->role->name == 'Admin') {
            $data_product = Product::get();
        } else {
            $data_product = Product::where('id_user', Auth::user()->id_user)->get();
        }

        if (count($data_product) > 0) {
            $data = [
                'less_10000' => 0,
                '_10000_20000' => 0,
                '_20000_50000' => 0,
                '_50000_100000' => 0,
                'more_100000' => 0
            ];
            foreach ($data_product as $key => $value) {
                if ($value->harga_satuan < 10000) {
                    $data['less_10000'] += 1;
                } elseif ($value->harga_satuan >= 10000 && $value->harga_satuan < 20000) {
                    $data['_10000_20000'] += 1;
                } elseif ($value->harga_satuan >= 20000 && $value->harga_satuan < 50000) {
                    $data['_20000_50000'] += 1;
                } elseif ($value->harga_satuan >= 50000 && $value->harga_satuan < 100000) {
                    $data['_50000_100000'] += 1;
                } else {
                    $data['more_100000'] += 1;
                }
            }
        }

        return response()->json($data);
    }
}
