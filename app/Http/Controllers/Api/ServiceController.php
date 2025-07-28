<?php
namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->get();
        return ServiceResource::collection($services);
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());

        return new ServiceResource($service);
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        // dd($request->validated()); // For debugging
        // \Log::info('Validated data:', $request->validated()); // For debugging

        $service->update($request->validated());

        return new ServiceResource($service);
    }

    public function destroy(Request $request, Service $service)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $service->delete();

        return response()->json(null, 204);
    }
}
