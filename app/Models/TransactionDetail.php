<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    public function product()
    {
        // return $this->belongsTo(Product::class, 'product_id', 'id');
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }

    protected $fillable = [
        'transaction_id',
        'product_id',
        'size_id',
        'qty',
        'status',
    ];
}
