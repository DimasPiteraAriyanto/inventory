<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnPurchase extends Model
{
    use HasFactory;


    protected $fillable = [
        'supplier_id',
        'return_date', // Add other columns as needed
        'return_no',
        'return_status',
        'total_amount',
        'created_by',
        'updated_by',
        // Add other columns as needed
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'supplier',
        'user_created',
        'user_updated',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function user_created(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function user_updated(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
