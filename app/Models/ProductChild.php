<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductChild extends Model
{
    use HasFactory;
    protected $table = 'items';

    protected $hidden = [

        'created_at',
        'updated_at'

     ];



    public function getImageAttribute($value)
    {
        // return 1111;
        // return  asset('/storage/'. $value);

        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'storage/' . $value);
    }
}
