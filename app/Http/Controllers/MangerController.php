<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Manger;
//use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;

class MangerController extends Controller
{
    public function insert(Request $request)
    {
        try {
            $file = $request->file('photo');
            if ($request->hasFile('photo')) {

                $name = $file->hashName();
                $file->store('manger', 'Manger');
                Manger::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'photo' => $name,

                ]);
            } else {
                Manger::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),

                ]);
            }

            return 'inserted succefully';
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function get_managers()
    {
        try {

            $mangers = Manger::all();
            return $mangers;
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $mangers
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_manager($id)
    {
        try {
            $manger = Manger::with('malls')->findOrFail($id);
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $manger
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update_manager(Request $request, $id)
    {
        try {
            $manger = Manger::findOrFail($id);
            if ($manger) {
                $manger->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),

                ]);
                return 'success updated';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function delete_manager($id)
    {
        try {
            $manger = Manger::findOrFail($id);
            if ($manger) {
                $manger->malls()->delete();
                $manger->delete();
                return 'success delete';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
