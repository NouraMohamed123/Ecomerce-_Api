<?php

namespace App\Http\Controllers;

use App\Models\VendorProduct;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{
    public function insert(Request $request)
    {
        try {
         VendorProduct::create([
             'vendor_id'=>$request->vendor_id,
             'product_id'=>$request->product_id,
             'price'=>$request->price,
             'note'=>$request->note
         ]);

        }catch (\Exception $e){
            return $e;
        }
    }
}
