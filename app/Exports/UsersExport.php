<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

//    protected $ids;
//
//    public function __construct(array $ids)
//    {
//        $this->ids = $ids;
//    }
//
//    public function array(): array
//    {
//        return $this->ids;
//    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

//        return "Hello World";
//        return Contact::all()->where('id',18);
        return Contact::all();
//        return Contact::all()->whereIn('id',[14,19,20]);
    }


}
