<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index($status)
    {
        $orders = Order::where('status', $status)
            ->whereHas('orderItems.productDeltail.product', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })
            ->with('orderItems.productDeltail.product')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('supplier.order.index', compact('orders', 'status'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems', 'transporter', 'voucher')->findOrFail($id);

        return view('supplier.order.show', compact('order'));
    }

    public function changeStatusOrder($id, $status)
    {
        $order = Order::findOrFail($id);
        $success = $order->update(array('status' => $status));
        $user = $order->user;
        $data = [
            'status' => statusOrder($order->status),
            'class' => classOrder($order->status),
            'icon' => iconOrder($order->status),
            'created_at' => Carbon::now()->toDateTimeString(),
            'order_id' => $order->id,
        ];

        $user->notify(new OrderNotification($data));

        if ($success) {
            Alert::success(trans('supplier.change_status_success'));
        } else {
            Alert::error(trans('supplier.change_status_false'));
        }

        return redirect()->back();
    }
}
