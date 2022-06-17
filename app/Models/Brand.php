<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

// class Brand extends Model
// class Brand extends Pivot

class Brand extends Model
{
    // use HasFactory;
    protected $table ='brands';

    protected $fillable =[
        'name',
        'description',  
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
