<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function insert(Request $request)
    {
        try {

            $photo = $request->file('photo');

            $photo_name = $photo->getClientOriginalName();

        if($request->hasFile('photo')){
            $photo->storeAs('photo/'. $photo_name, $photo_name, 'photo');

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'manufacture_company' => $request->manufacture_company,
                'photo'=> $photo_name

            ]);
        }else{
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'manufacture_company' => $request->manufacture_company,


            ]);
        }

            return 'inserted succefully';
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function get_products()
    {
        try {
            $product =  Product::with('vendors')->get();
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_product($id)
    {
        try {
            $product = Product::with('vendors')->findOrFail($id);
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update_product(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product) {
                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'manufacture_company' => $request->manufacture_company,

                ]);
                return 'success updated';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function delete_product($id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product) {
                $product->delete();
                return 'success delete';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

}
