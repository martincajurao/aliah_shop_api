<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'desc',
        'product_category',
        'stocks',
        'img',
    ];
    public function category() {
        return $this->belongsTo(Category::Class,'product_category');
    }
    public function transaction(){
        return $this->belongsToMany(Transaction::class, 'product_transactions', 'product_id', 'transaction_id');
    }
}
