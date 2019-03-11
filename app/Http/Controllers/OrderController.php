<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class OrderController extends Controller {

    /**
     * Add new order 
     * @param Request $request
     * @param type $product_id
     * @return type
     */
    public function store(Request $request, $product_id) {
        $validator = Validator::make($request->all(), [
                    'count' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json(['state' => 'failed', 'messages' => $validator->errors()]);
        }

        $order = new \App\Order;
        $order->product_id = $product_id;
        $order->count = $request->count;
        if ($order->save()) {
            return response()->json(['state' => 'success', 'messages' => 'You did it !']);
        } else {
            return response()->json(['state' => 'failed', 'messages' => 'something goes wrong!']);
        }
    }

}
