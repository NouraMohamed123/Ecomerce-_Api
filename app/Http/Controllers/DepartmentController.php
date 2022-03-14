<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function insert(Request $request)
    {
        try {


            Department::create([
                'mall_id' => $request->mall_id,
                'name' => $request->name,
                'description' => $request->description,
                'note' => $request->note,

            ]);
            return 'inserted succefully';
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_departments()
    {
        try {
            $departments = Department::with('mall')->get();
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $departments
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_department($id)
    {
        try {
            $department = Department::with(['mall' => function ($q) {
                $q->select('id', 'name');
            }])->findOrFail($id);
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'data' => $department
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update_department(Request $request, $id)
    {
        try {
            $department = Department::findOrFail($id);
            if ($department) {
                $department->update([
                    'mall_id' => $request->mall_id,
                    'name' => $request->name,
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
    public function delete_department($id)
    {
        try {
            $department = Department::findOrFail($id);
            if ($department) {
                $department->delete();
                return 'success delete';
            } else {
                return 'not found';
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
