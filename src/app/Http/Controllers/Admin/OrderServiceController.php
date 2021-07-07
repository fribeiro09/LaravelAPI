<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderServiceCollection;
use App\Http\Resources\OrderServiceResource;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderServiceController extends Controller
{
    private $repository;

    public function __construct(OrderService $orderService)
    {
        $this->repository = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderServices = $this->repository->orderBy('id')->get();
        return response(new OrderServiceCollection($orderServices), 200);
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
        $validator = Validator::make($data, OrderServiceValidator());

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
        if(!$orderService = OrderService::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return new OrderServiceResource($orderService);
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
        $validator = Validator::make($data, OrderServiceValidator());

        if(!$orderService = OrderService::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 422);
        }

        $orderService->fill($data);
        $orderService->save();

        return response()->json($orderService, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$orderService = OrderService::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $orderService->delete();

        return response(['message' => 'The Record id #'.$id.' has been deleted'], 200);
    }
}
