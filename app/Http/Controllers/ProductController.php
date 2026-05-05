<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Tampilkan Data
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }

    // Tambah Data
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|integer|min:1'
        ]);

        try {
            // Refactor ke Service
            $product = $this->productService->store($validated);

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $product
            ]);
        } catch (\Exception $e) {

            // Error Handling
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Ubah Data
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name'  => $request->name,
            'price' => $request->price
        ]);

        return response()->json([
            'message' => 'Data berhasil diubah',
            'data' => $product
        ]);
    }

    // Hapus Data
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}   