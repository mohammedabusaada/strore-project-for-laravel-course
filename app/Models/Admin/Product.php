<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'quantity', 'price', 'description', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
