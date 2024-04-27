<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);

        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        return view('admin.orders.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
            $requestData = $request->all();
            Log::info($requestData['items']);
            $order = Order::create($requestData);
            $items = $request->items;

            if (!empty($items)) {
                foreach ($items as $item) {
                    $amount = isset($item['amount']) ? $item['amount'] : 0.00;
                    $qty    = isset($item['qty'])    ? $item['qty']   : null;
                    $total  = $amount * $qty;
                    OrderItem::create([
                        'order_id'  => $order->id,
                        'item_name' => isset($item['item_name']) ? $item['item_name'] : null,
                        'qty'       => isset($item['qty'])       ? $item['qty']       : null,
                        'amount'    => isset($item['amount'])    ? $item['amount']    : 0.00,
                        'total'     =>  $total ?? 0.00,
                    ]);
                }
            }
            $order->total = $order->items->sum('total');
            $order->save();
            return redirect(route('admin.orders.index'))->with('success', 'Order created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
