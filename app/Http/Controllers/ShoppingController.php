<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ShoppingController extends Controller
{
    public function singleShopping(Product $product, $data)
    {
        try {
            $data =  Crypt::decrypt($data);
            $data = explode('|', $data);
        } catch (\Throwable $th) {
            abort(403);
        }

        $amount = $data[0];
        $price  = $data[1];

        return view('checkout.single-product', [
            'product' => $product,
            'price'   => $price,
            'amount'  => $amount,
        ]);
    }

    public function paymentSingleProduct(Product $product, $data)
    {
        try {
            $data =  Crypt::decrypt($data);
            $data = explode('|', $data);
        } catch (\Throwable $th) {
            abort(403);
        }
        
        $shopData = [
            'amount'  => $data[0],
            'price'   => $data[1],
            'address' => $data[2],
        ];

        return view('checkout.payment', [
            'product' => $product,
            'shopData'=> $shopData,
        ]);
    }

    public function basicCheckout(Request $request, $data)
    {
        try {
            $data =  Crypt::decrypt($data);
        } catch (\Throwable $th) {
            abort(403);
        }

        // Order::findOrFail($data);

        return view('checkout.checkout');
    }
}
