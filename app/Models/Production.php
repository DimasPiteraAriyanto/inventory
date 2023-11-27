<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Production extends Model
{
    use HasFactory, Sortable;
    protected $fillable = ['name', 'unit_id', 'code_item', 'start_date', 'end_date', 'detail', 'quantity'];
    public $sortable = ['name', 'unit_id', 'code_item', 'start_date', 'end_date', 'quantity'];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'itemProducts',
        'unit'
    ];


    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function itemProducts()
    {
        return $this->hasMany(ItemProduct::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'name');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

}
