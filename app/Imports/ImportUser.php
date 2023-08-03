<?php
namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User_model;
class ImportUser implements ToModel
{
   public function model(array $row)
   {
    
        return new User_model([
           'name' => $row[0],
           'email' => $row[1],
       ]);
   }
}