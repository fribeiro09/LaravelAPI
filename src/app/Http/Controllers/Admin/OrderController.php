<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $repository;

    public function __construct(Order $order)
    {
        $this->repository = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->repository->orderBy('id')->get();
        return response(new OrderCollection($orders), 200);
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
        $validator = Validator::make($data, OrderValidator());

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
        if(!$order = Order::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return new OrderResource($order);
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
        $validator = Validator::make($data, OrderValidator());

        if(!$order = Order::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 422);
        }

        $order->fill($data);
        $order->save();

        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$order = Order::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $order->delete();

        return response(['message' => 'The Record id #'.$id.' has been deleted'], 200);
    }
}
