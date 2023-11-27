<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'product_name',
        'category_id',
        'unit_id',
        'product_code',
        'stock',
        'buying_price',
        'selling_price',
        'product_image',
        'weight',
        'brand_id',
        'group_id',
        'grade_id',
        'type_id',
        'item_type_id',
        'made_in_id',
        'min_stock',
        'discount_price',
        'discount_percent',
    ];

    public $sortable = [
        'product_name',
        'category_id',
        'unit_id',
        'product_code',
        'stock',
        'buying_price',
        'selling_price',
        'supplier_id'
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'category',
        'unit'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function detailMasterValueBrand()
    {
        return $this->belongsTo(DetailMasterValue::class, 'brand_id');
    }

    public function detailMasterValueGrade()
    {
        return $this->belongsTo(DetailMasterValue::class, 'grade_id');
    }

    public function detailMasterValueGroup()
    {
        return $this->belongsTo(DetailMasterValue::class, 'group_id');
    }

    public function detailMasterValueType()
    {
        return $this->belongsTo(DetailMasterValue::class, 'type_id');
    }

    public function detailMasterValueItemType()
    {
        return $this->belongsTo(DetailMasterValue::class, 'item_type_id');
    }

    public function detailMasterValueMadeIn()
    {
        return $this->belongsTo(DetailMasterValue::class, 'made_in_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('product_name', 'like', '%' . $search . '%');
        });
    }
}
