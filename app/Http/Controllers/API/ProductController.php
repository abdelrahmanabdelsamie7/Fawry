<?php
namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
class ProductController extends BaseController
{
    protected string $modelClass = Product::class;
    protected string $requestClass = ProductRequest::class;
}
