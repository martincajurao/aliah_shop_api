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
        return $this->belongsTo(Transaction::class, 'Product_transaction', 'product_id', 'transaction_id');
    }
}
