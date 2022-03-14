<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function insert(Request $request)
    {
        try {

            $logo = $request->file('logo');

            $logo_name = $logo->getClientOriginalName();

        if($request->hasFile('logo')){
            $logo->storeAs('logo/' . $logo_name,  $logo_name, 'logo');

            Vendor::create([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'phone'=>$request->phone,
                'description' => $request->description,
                'note' => $request->note,
                'logo'=> $logo_name

            ]);
        }else{
            Vendor::create([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'phone'=>$request->phone,
                'description' => $request->description,
                'note' => $request->note,
                'logo'=> $logo_name

            ]);
        }

            return 'inserted succefully';
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function get_vendors()
    {
        try {
            $vendors = Vendor::with(['department' => function($q){
                $q->select('id','name','description');
            }])->with('products')->get();
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $vendors
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_vendor($id)
    {
        try {
            $vendor = Vendor::with(['department' => function($q){
                $q->select('id','name','description');
            }])->findOrFail($id);
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $vendor
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update_vendor(Request $request, $id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            if ($vendor) {
                $vendor->update([
                    'department_id' => $request->department_id,
                    'name' => $request->name,
                    'phone'=>$request->phone,
                    'description' => $request->description,
                    'note' => $request->note,

                ]);
                return 'success updated';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function delete_vendor($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            if ($vendor) {
                $vendor->delete();
                return 'success delete';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

}
