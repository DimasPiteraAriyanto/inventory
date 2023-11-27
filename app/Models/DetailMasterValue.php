<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class DetailMasterValue extends Model
{
    use HasFactory, Sortable;

//    protected $table = ['detail_master_values'];

    protected $fillable = [
        'name',
        'master_value_id',
        'description'
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

//    public function masterValue()
//    {
//        return $this->belongsTo(MasterValue::class);
//    }
}
