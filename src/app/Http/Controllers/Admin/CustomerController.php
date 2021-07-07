<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    private $repository;

    public function __construct(Customer $customer)
    {
        $this->repository = $customer;
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->repository->orderBy('id')->get();
        return response(new CustomerCollection($customers), 200);
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
        $validator = Validator::make($data, CustomerValidator());

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
        if(!$customer = Customer::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return new CustomerResource($customer);
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
        $validator = Validator::make($data, CustomerValidator($id));

        if(!$customer = Customer::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 422);
        }

        $customer->fill($data);
        $customer->save();

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$customer = Customer::find($id)) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $customer->delete();

        return response(['message' => 'The Record id #'.$id.' has been deleted'], 200);
    }
}
