<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::all();
    }

//    public function download(string $string, string $XLSX)
//    {
////        return Contact::all();
//
//    }
}
