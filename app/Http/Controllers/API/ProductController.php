<?php
namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{
    protected string $modelClass = Product::class;
    protected string $itemName = 'Product';
    protected string $requestClass = ProductRequest::class;
    protected ?string $resourceClass = ProductResource::class;
}