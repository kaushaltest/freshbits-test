<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_model;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Validators\ValidationException;
class User extends Controller
{
   
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User_model();
    }

    public function import(Request $request)
    {

      
        try {
            $status = Excel::import(new ImportUser, $request->file('file')->store('files'));
    
            return response()->json([
                'success' => true,
                'message' => 'Excel file uploaded and imported successfully',
            ], 200);
        } catch (ValidationException $e) {
            $failures = $e->failures();
    
            // $errorMessages = [];
            // foreach ($failures as $failure) {
            //     $errorMessages[] = "Row: {$failure->row()}, Attribute: {$failure->attribute()}, Error: {$failure->errors()[0]}";
            // }
    
            // return response()->json([
            //     'success' => 0,
            //     'message' => 'Excel file import failed',
            //     'errors' => $errorMessages,
            // ], 422);
        }
    
    }
     public function getUser(Request $request)
    {
        $userList = $this->userModel->getUser();
        if (count($userList)) {
            return response()->json([
                'success' => 1,
                'data' => $userList,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'data' => "",
            ], 200);
        }
    }

    public function addUser(Request $request)
    {
        $addData=[
            "name" => $request->input('name'),
            "email" => $request->input('email'),
        ];
        $status = $this->userModel->addUser($addData);
        if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "User add successfully",
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => "User not added",
            ], 200);
        }
    }

    public function editUser(Request $request)
    {

        $editData=[
            "name" => $request->input('name'),
            "email" => $request->input('email'),
        ];

        $status = $this->userModel->editUser($request->input('user_id'), $editData);
        if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "User update successfully",
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => "User not updated",
            ], 200);
        }
    }

    public function deleteUser(Request $request)
    {
        $status = $this->userModel->deleteUser($request->input('user_id'));
        if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "User delete successfully",
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => "User not deleted",
            ], 200);
        }
    }
    
}
    

