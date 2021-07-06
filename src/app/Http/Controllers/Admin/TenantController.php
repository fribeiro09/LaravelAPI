<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();
        return response()->json($tenants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validator = Validator::make($data, TenantValidator());

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
        if(!$tenant = Tenant::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        return response()->json($tenant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($data, TenantValidator($id));

        if(!$tenant = Tenant::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 422);
        }

        $tenant->fill($data);
        $tenant->save();

        return response()->json($tenant, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$tenant = Tenant::find($id)) {
            return response()->json(['message' => 'Record not found',], 404);
        }

        $tenant->delete();

        return response(['message' => 'The Record id #'.$id.' has been deleted'], 200);
    }
}
