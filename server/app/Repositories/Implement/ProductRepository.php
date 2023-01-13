<?php

namespace App\Repositories\Implement;

use App\Models\Product;
use App\Repositories\Interface\IProductRepository;

class ProductRepository implements IProductRepository
{
    public function getList(array $data)
    {
        $products = Product::all();
        
        return $products;
    }
    
    public function save(array $data)
    {
        $product = new Product();

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];

        $product->save();

        return $product->refresh();
    }

    public function findById(int $id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function update(array $data, int $id)
    {
        $product = Product::find($id);

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];

        $product->save();

        return $product->refresh();
    }

    public function delete(int $id)
    {
        $product = Product::find($id);

        $product->delete();

        return $product->refresh();
    }
}
