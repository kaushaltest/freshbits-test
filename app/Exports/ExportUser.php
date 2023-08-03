<?php
    namespace App\Exports;
    use App\Models\User_model;
    use Maatwebsite\Excel\Concerns\FromCollection;
 
    class ExportUser implements FromCollection {
        public function collection()
        {
            return User_model::select('name','email')->get();
        }
    }
?>