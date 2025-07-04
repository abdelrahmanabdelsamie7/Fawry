<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
class CustomerController extends BaseController
{
    protected string $modelClass = Customer::class;
    protected string $itemName = 'Customer';

    protected string $requestClass = CustomerRequest::class;
}
