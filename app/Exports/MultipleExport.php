<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class MultipleExport implements FromArray
{

    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        $ids = $this->invoices;
//        return $ids;
        $newArr = [];
        foreach ($ids[0] as $key=>$values){
//            dd($values);
            array_push($newArr,$values);
        }

//        dd($newArr[0]);
        return [Contact::all()->whereIn('id',$newArr[0])];
    }


    /**
    * @return \Illuminate\Support\Collection
    */



}
