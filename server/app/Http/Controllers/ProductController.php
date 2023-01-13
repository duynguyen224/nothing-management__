<?php

namespace App\Http\Controllers;

use App\Enums\Direction;
use App\Models\Product;
use App\Services\Interface\IProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $query = $request->query();
        $data = array(
            'search' => $query['search'],
            'sortDir' => $request->has('sortDir') ? $query['sortDir'] : Direction::DESC,
            'sortBy' => $request->has('sortBy') ? $query['sortBy'] : 'ID',
        );

        $result = ['status' => 200];
        $result['data'] = $this->productService->getList($data);

        return response()->json($result, $result['status']);
    }

    public function create(Request $request)
    {
        $data = $request->only([
            'name', 'price', 'category_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->saveProduct($data);
        } catch (Exception $ex) {
            $result = [
                'status' => 500,
                'error' => $ex->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function detail(Request $request)
    {
        $productId = intval($request->id);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->findProductById($productId);
        } catch (Exception $ex) {
            $result = [
                'status' => 500,
                'error' => $ex->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(Request $request)
    {
        $id = intval($request->id);
        $data = $request->only([
            'name', 'price', 'category_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->updateProduct($data, $id);
        } catch (Exception $ex) {
            $result = [
                'status' => 500,
                'error' => $ex->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $id = intval($request->id);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->deleteProduct($id);
        } catch (Exception $ex) {
            $result = [
                'status' => 500,
                'error' => $ex->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
