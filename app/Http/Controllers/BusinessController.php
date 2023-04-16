<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $business = auth()->user();
        $clients = User::role('client')->get();
        return view('business.cabinet', compact('business', 'clients'));
    }

    public function callback(Request $request)
    {
        // Обработка ответа от TarlanPayments
        $status = $request->input('status');
        $reference_id = $request->input('reference_id');

        // Обновление статуса заказа в базе данных
        $order = Order::where('reference_id', $reference_id)->first();
        $order->status = $status;
        $order->save();

        // Отправка ответа об успешной обработке запроса
        return response()->json(['success' => true]);
    }
}
