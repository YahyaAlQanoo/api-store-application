<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(ProductChild::class, 'product_id');
    }

    protected $hidden = [
        'product_id','active'
        
     ];

    public function getImageAttribute($value)
    {
        // return 1111;
        // return  asset('/storage/'. $value);

        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'storage/' . $value);
    }
}
