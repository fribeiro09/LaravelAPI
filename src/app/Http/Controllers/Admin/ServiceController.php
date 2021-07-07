<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    private $repository;

    public function __construct(Service $service)
    {
        $this->repository = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->repository->orderBy('id')->get();
        return response(new ServiceCollection($services), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, ServiceValidator());

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 422);
        }

        $this->repository->fill($data);
        $this->repository->save();

        return response()->json($this->repository, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$service = Service::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->id = $id;
        $validator = Validator::make($data, ServiceValidator());

        if(!$service = Service::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 422);
        }

        $service->fill($data);
        $service->save();

        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$service = Service::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $service->delete();

        return response(['message' => 'The Record id #'.$id.' has been deleted'], 200);
    }
}
