<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

// class Product extends Model
// class Product extends Pivot

class Product extends Model
{
    // use HasFactory;
    // public const STATUS_ACTCIVE = 1;
    // public const STATUS_INACTCIVE = 0;
    protected $table ='products';
   
    protected $fillable =[
        'category-id',
        'brand-id',
        'title',
        'description',
        'quantity',
        'selling_price',
        'original_price',
        // 'year',
    ];

    protected $with = ['category','brand'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

   
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

   
    
   

    
   
}
