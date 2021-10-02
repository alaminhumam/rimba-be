<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Sales\CreateRequest;
use App\Http\Requests\Api\Sales\UpdateRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\Resource;
use App\Http\Resources\SalesCollection;
use App\Http\Resources\SalesResource;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::with('itemSales.item')->get();

        return new SalesCollection($sales);
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

        DB::beginTransaction();
        try {
            $data['transaction_code'] = Str::random(10);

            $customer = Customer::findOrFail($data['customer_id']);

            $itemSales = [];
            $totalQty = 0;
            $totalDiscount = 0;
            $totalPrice = 0;
            $totalPay = 0;
            foreach ($data['items'] as $key => $item) {
                $itemSales[$key]['item_id'] =  $item['id'];
                $itemSales[$key]['qty'] = $item['qty'];

                $dataItem = Item::findOrFail($item['id']);

                $totalPrice += $dataItem->price;
                $totalQty += $itemSales[$key]['qty'];
            }

            if ($customer->discountActive()->count() > 0) {
                if ($customer->discounts()->first()->type == 'fix') {
                    $totalDiscount = $customer->discounts()->first()->amount;
                } else {
                    $totalDiscount = $totalPrice * ($customer->discounts()->first()->amount / 100);
                }
            }

            $totalPay = $totalPrice - $totalDiscount;

            $data['total_pay'] = $totalPay;
            $data['total_price'] = $totalPrice;
            $data['total_discount'] = $totalDiscount;
            $data['total_qty'] = $totalQty;
            $data['customer_id'] = $customer->id;

            $sales = Sales::create($data);
            foreach ($itemSales as $value) {
                $sales->itemSales()->create($value);
            }

            DB::commit();

            return new SalesResource($sales);
        } catch (\Throwable $th) {
            DB::rollBack();

            return new ErrorResource([
                'query' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales = Sales::findOrFail($id);

        return new SalesResource($sales);
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

        $sales = $request->sales;

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($data['customer_id']);

            $itemSales = [];
            $totalQty = 0;
            $totalDiscount = 0;
            $totalPrice = 0;
            $totalPay = 0;
            foreach ($data['items'] as $key => $item) {
                $itemSales[$key]['item_id'] =  $item['id'];
                $itemSales[$key]['qty'] = $item['qty'];

                $dataItem = Item::findOrFail($item['id']);

                $totalPrice += $dataItem->price;
                $totalQty += $itemSales[$key]['qty'];
            }

            if ($customer->discountActive()->count() > 0) {
                if ($customer->discounts()->first()->type == 'fix') {
                    $totalDiscount = $customer->discounts()->first()->amount;
                } else {
                    $totalDiscount = $totalPrice * ($customer->discounts()->first()->amount / 100);
                }
            }

            $totalPay = $totalPrice - $totalDiscount;

            $data['total_pay'] = $totalPay;
            $data['total_price'] = $totalPrice;
            $data['total_discount'] = $totalDiscount;
            $data['total_qty'] = $totalQty;
            $data['customer_id'] = $customer->id;

            $sales->update($data);
            foreach ($itemSales as $value) {
                $sales->itemSales()->update($value);
            }

            DB::commit();

            return new SalesResource($sales);
        } catch (\Throwable $th) {
            DB::rollBack();

            return new ErrorResource([
                'query' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales = Sales::findOrFail($id);
        $sales->itemSales()->delete();
        $sales->delete();

        return new Resource();
    }
}
