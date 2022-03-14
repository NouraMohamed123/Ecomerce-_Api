<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use Illuminate\Http\Request;

class MallController extends Controller
{
    public function insert(Request $request)
    {
        try {

            if ($request->hasFile('photo')) {



                $Mall_file = $request->file('photo');

                $Mall_file_name = $Mall_file->getClientOriginalName();


                $Mall_file->storeAs('mail/' . $Mall_file_name, $Mall_file_name, 'mail');

                Mall::create([
                    'manager_id' => $request->manager_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'space' => $request->space,
                    'note' => $request->note,
                    'photo' => $Mall_file_name,

                ]);
            } else {
                Mall::create([
                    'manager_id' => $request->manager_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'space' => $request->space,
                    'note' => $request->note,

                ]);
            }

            return 'inserted succefully';
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function get_malls()
    {
        try {
            $malls = Mall::get();
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $malls
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_mall($id)
    {
        try {
            $mall = Mall::with('manger')->findOrFail($id);
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $mall
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update_mall(Request $request, $id)
    {
        try {
            $mall = Mall::findOrFail($id);
            if ($mall) {
                $mall->update([
                    'manager_id' => $request->manager_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'space' => $request->space,
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
    public function delete_mall($id)
    {
        try {
            $mall = Mall::findOrFail($id);
            if ($mall) {
                $mall->departments()->delete();
                $mall->delete();
                return 'success delete';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
