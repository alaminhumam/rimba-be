<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\CreateRequest;
use App\Http\Requests\Api\Customer\UpdateRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\Resource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return new CustomerCollection($customers);
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
    public function store(CreateRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $data['image'] = $image->storeAs('customer', $fileName, 'public');
        }

        $customer = Customer::Create($data);
        if (!empty($data['discount_id'])) {
            $customer->discounts()->attach(['discount_id' => $data['discount_id']]);
        }

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return new CustomerResource($customer);
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
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();

        $customer = $request->customer;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($customer->image);
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $data['image'] = $image->storeAs('customer', $fileName, 'public');
        } else {
            $data['image'] = $customer->image;
        }

        $customer->update($data);
        if (!empty($data['discount_id'])) {
            $customer->discounts()->detach();
            $customer->discounts()->attach(['discount_id' => $data['discount_id']]);
        }

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return new Resource();
    }
}
