<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

//        return "Hello World";
        return Contact::all()->where('id',14);
//        return Contact::all();
//        return Contact::all()->whereIn('id',[14,19,20]);
    }


}
