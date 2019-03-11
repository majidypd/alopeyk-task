<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;

class ProductController extends Controller {

    /**
     * Add new product by seller(store)
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'amount' => 'required|integer',
                    'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['state' => 'failed', 'messages' => $validator->errors()]);
        }

        $product = new \App\Product;
        $product->title = $request->title;
        $product->amount = $request->amount;
        $product->price = $request->price;
        $product->user_id = Auth::id();
        if ($product->save()) {
            return response()->json(['state' => 'success', 'messages' => 'You did it !']);
        } else {
            return response()->json(['state' => 'failed', 'messages' => 'something goes wrong!']);
        }
    }

    /**
     * Get list of all product of nearby store
     * @param type $radius
     * @return type
     */
    public function getList($radius = 100) {
        $results = DB::select(DB::raw('SELECT users.id, ( 3959 * acos( cos( RADIANS(' . Auth::user()->lat . ') ) * cos( RADIANS( lat ) ) * cos( RADIANS( lng ) - RADIANS(' . Auth::user()->lng . ') ) + sin( RADIANS(' . Auth::user()->lat . ') ) * sin( RADIANS(lat) ) ) ) AS distance FROM users JOIN role_user ON (role_user.user_id = users.id AND role_user.role_id=2) WHERE users.id != ' . Auth::id() . ' HAVING distance < ' . $radius . " ORDER BY distance"));
        if (!empty($results[0]->id)) {
            $productList = \App\Product::select()->where("user_id", $results[0]->id)->get()->toArray();
            return response()->json(['state' => 'success', 'data' => $productList]);
        }
    }

}
