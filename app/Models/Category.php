<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

// class Category extends Model
// class Category extends Pivot

class Category extends Model
{
    // use HasFactory;

    protected $table ='categories';

    protected $fillable =['name', 'description',];

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

}
