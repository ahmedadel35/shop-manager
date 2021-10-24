<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $reqValidation = [
        "category_id" => "required|integer|exists:categories,id",
        "title" => "required|string|max:255",
        "amount" => "required|integer|min:1",
        "price" => "required|min:1",
    ];

    public function index(Category $category)
    {
        $category->loadMissing("products");
        $products = $category->products;
        // $output = [];

        // foreach ($products as $product) {
        //     $output[] = (object) [
        //         "label" => $product->title,
        //         "value" => $product->slug,
        //         "img" => $product->img,
        //     ];
        // }

        return response()->json($products);
    }

    public function store()
    {
        $req = (object) request()->validate($this->reqValidation);

        return response()->json(
            Product::create([
                "category_id" => $req->category_id,
                "title" => $req->title,
                "amount" => $req->amount,
                "price" => $req->price,
            ])
        );
    }

    public function update(Product $product) {
        $req = (object) request()->validate($this->reqValidation);

        $product->title = $req->title;
        $product->price = $req->price;
        $product->amount = $req->amount;

        return response()->json([
            'done' => $product->update(),
        ]);
    }

    public function destroy(Product $product)
    {
        return response()->json([
            "done" => $product->delete(),
        ]);
    }
}
