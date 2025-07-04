<?php
namespace App\Http\Controllers\API;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
class BaseController extends Controller
{
    use ResponseJsonTrait;
    protected string $modelClass;
    protected string $requestClass;
    public function index()
    {
        $items = $this->modelClass::all();
        return $this->sendSuccess("All items fetched successfully.", $items);
    }
    public function store()
    {
        $data = app($this->requestClass)->validated();
        $item = $this->modelClass::create($data);
        return $this->sendSuccess("Item created successfully.", $item, 201);
    }
    public function show($id)
    {
        $item = $this->modelClass::find($id);
        if (!$item) return $this->sendError("Item not found", 404);
        return $this->sendSuccess("Item fetched successfully.", $item);
    }
    public function update($id)
    {
        $item = $this->modelClass::find($id);
        if (!$item) return $this->sendError("Item not found", 404);
        $data = app($this->requestClass)->validated();
        $item->update($data);
        return $this->sendSuccess("Item updated successfully.", $item);
    }
    public function destroy($id)
    {
        $item = $this->modelClass::find($id);
        if (!$item) return $this->sendError("Item not found", 404);
        $item->delete();
        return $this->sendSuccess(null, "Item deleted successfully.");
    }
}
