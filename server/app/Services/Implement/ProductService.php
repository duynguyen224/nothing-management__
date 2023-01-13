<?php

namespace App\Services\Implement;

use App\Repositories\Implement\ProductRepository;
use App\Repositories\Interface\IProductRepository;
use App\Services\Interface\IProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Ramsey\Uuid\Type\Integer;

class ProductService implements IProductService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getList(array $data)
    {
        $validator = Validator::make($data, [
            'search' => 'required',
            'sortDir' => 'required',
            'sortBy' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->productRepository->getList($data);

        return $result;
    }

    public function saveProduct(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->productRepository->save($data);

        return $result;
    }

    public function findProductById(int $id)
    {
        $result = $this->productRepository->findById($id);

        return $result;
    }

    public function updateProduct(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->productRepository->update($data, $id);

        return $result;
    }

    public function deleteProduct(int $id)
    {
        $result = $this->productRepository->delete($id);

        return $result;
    }
}
