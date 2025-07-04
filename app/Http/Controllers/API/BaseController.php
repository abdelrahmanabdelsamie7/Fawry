<?php
namespace App\Http\Controllers\API;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
class BaseController extends Controller
{
    use ResponseJsonTrait;
    protected string $modelClass;
    protected string $itemName ;
    protected string $requestClass;
    protected ?string $resourceClass = null;

    protected function applyResource($data)
    {
        if ($this->resourceClass && $data) {
            return $data instanceof Collection
                ? $this->resourceClass::collection($data)
                : new $this->resourceClass($data);
        }
        return $data;
    }
    public function index()
    {
        $items = $this->modelClass::all();
        return $this->sendSuccess("All {$this->itemName}s fetched successfully.", $this->applyResource($items));
    }
    public function store()
    {
        $data = app($this->requestClass)->validated();
        $item = $this->modelClass::create($data);
        return $this->sendSuccess("{$this->itemName} created successfully.", $item, 201);
    }
    public function show($id)
    {
        $item = $this->modelClass::find($id);
        if (!$item)
            return $this->sendError("{$this->itemName} not found", 404);
        return $this->sendSuccess("{$this->itemName} fetched successfully.", $this->applyResource($item));
    }
    public function update($id)
    {
        $item = $this->modelClass::find($id);
        if (!$item)
            return $this->sendError("{$this->itemName} not found", 404);
        $data = app($this->requestClass)->validated();
        $item->update($data);
        return $this->sendSuccess("{$this->itemName} updated successfully.", $item);
    }
    public function destroy($id)
    {
        $item = $this->modelClass::find($id);
        if (!$item)
            return $this->sendError("{$this->itemName} not found", 404);
        $item->delete();
        return $this->sendSuccess( "{$this->itemName} deleted successfully.");
    }
}
