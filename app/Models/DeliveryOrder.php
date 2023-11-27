<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_order',
        'invoice_description',
        'delivery_number',
        'ship_via',
        'delivery_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
