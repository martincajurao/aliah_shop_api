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
        return $this->belongsToMany(Product::class, 'product_transactions', 'transaction_id', 'product_id');
    }

    public function orderline() {
        return $this->hasMany(Product_transaction::class);
    }
}
