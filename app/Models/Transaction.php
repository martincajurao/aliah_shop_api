<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'Product_transaction', 'transaction_id', 'product_id');
    }
}
