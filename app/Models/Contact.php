<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['fname','lname','company','job','email','phone','birthday','note','photos'];

    public static function randColorBackground(){
        $colors = array ("#9A1663","#E0144C","#FF5858","#FF97C1");
        $color = $colors[array_rand($colors)];
        return $color;
    }
}
