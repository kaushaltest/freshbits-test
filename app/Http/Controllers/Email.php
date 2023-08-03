<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email_model;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User_model;
use Maatwebsite\Excel\Validators\ValidationException;
class Email extends Controller
{
    protected $emailModel;
    public function __construct()
    {
        $this->emailModel = new Email_model();
    }

     public function getEmailTemplate(Request $request)
    {
        $emailTemplateList = $this->emailModel->getEmailTemplate();
        if (count($emailTemplateList)) {
            return response()->json([
                'success' => 1,
                'data' => $emailTemplateList,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'data' => "",
            ], 200);
        }
    }

    public function addEmailTemplate(Request $request)
    {
        $addData=[
            "subject" => $request->input('subject'),
            "content" => $request->input('content'),
        ];
        $status = $this->emailModel->addEmailTemplate($addData);
        if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "Email template add successfully",
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => "Email template not added",
            ], 200);
        }
    }

    public function editEmailTemplate(Request $request)
    {

        $editData=[
            "subject" => $request->input('subject'),
            "content" => $request->input('content'),
        ];

        $status = $this->emailModel->editEmailTemplate($request->input('template_id'), $editData);
        if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "Email template update successfully",
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => "Email template not updated",
            ], 200);
        }
    }

    public function deleteEmailTemplate(Request $request)
    {
        $status = $this->emailModel->deleteEmailTemplate($request->input('template_id'));
        if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "Email template delete successfully",
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => "Email template not deleted",
            ], 200);
        }
    }

    public function sendEmail(Request $request)
    {
        $status=false;
        try{
            foreach ($request->input('users') as $userId) {
                $emailData = Email_model::find($request->input('emailtemplate_id'));
               $userData = User_model::find($userId);
               
               Mail::to($userData['email'])->send(new WelcomeEmail($emailData['subject'],$emailData['content'],$userData['name']));
               $status=true;
           }
           if ($status) {
            return response()->json([
                'success' => 1,
                'message' => "Email send successfully",
            ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'message' => "Email not send try angin",
                ], 200);
            }
        }
        catch(ValidationException $e)
        {
            return response()->json([
                        'success' => 0,
                        'message' => $e,
                    ], 500);
        }
        
       
    }

}
