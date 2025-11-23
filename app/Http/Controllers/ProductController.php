<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getData()
    {
        $product = Product::all();
        return response()->json([
            'message' => 'Berhasil get data Produk',
            'success' => true,
            'data'    => $product,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'message' => 'Selamat datang di dashboard! ',
            'success' => true,
            'data'    => $product,
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
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'sku' => 'required|unique:Products,sku',
                'quantity' => 'required|numeric|min:1',
                'price' => 'required|numeric',
            ]);

            $attr = Product::create($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil',
                'data' => $attr
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Transaksi gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product) {
                return response()->json([
                    'message' => 'Selamat datang di dashboard User! ',
                    'success' => true,
                    'data'    => $product,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data tidak ada! ',
                    'success' => true,
                    'data'    => $product,
                ]);
            }
        } catch (\Exception  $e) {
            return response()->json([
                'message' => $e,
                'success' => false,
            ]);
        }
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
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'sku' => 'required',
                'quantity' => 'required|numeric|min:1',
                'price' => 'required|numeric',
            ]);
            $attr = Product::findOrFail($id);
            $attr->update($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil',
                'data' => $attr
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Transaksi gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attr = Product::findOrFail($id);
        $attr->delete();
        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil Dihapus',
        ]);
    }
}
