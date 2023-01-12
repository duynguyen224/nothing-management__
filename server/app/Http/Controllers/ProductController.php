<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Interface\IProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = DB::table('products')->paginate(2);
        return response()->json($products, '200');
    }

    public function create()
    {
        return 'product create';
    }

    public function detail()
    {
        return 'product detail';
    }

    public function update()
    {
        return 'product update';
    }

    public function delete()
    {
        return 'product delete';
    }
}
