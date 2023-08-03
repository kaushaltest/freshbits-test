<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email_model extends Model
{
    public $timestamps=false;
    protected $table = 'emailtemplate';
  
    public function getEmailTemplate()
    {
        return Email_model::all();
    }

    public function addEmailTemplate($addData)
    {
        return  Email_model::insert($addData);
    }

    public function editEmailTemplate($templateId, $editData)
    {
        return Email_model::where('id', $templateId)->update($editData);
    }

    public function deleteEmailTemplate($templateId)
    {
        return  Email_model::where('id', $templateId)->delete();
    }
}
