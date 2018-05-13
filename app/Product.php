<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public static function filterClothes($part, $full)
    {
        if ($full == Null)
        {
            return [$part];
        }
        else
        {
            return array_merge($full, [$part]);
        }
    }

    public function category()
    {
        return $this->belongsTo('\App\Category');
    }

    public function order()
    {
        return $this->hasMany('\App\Order');
    }
}
