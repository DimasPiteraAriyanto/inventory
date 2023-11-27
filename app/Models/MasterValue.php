<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MasterValue extends Model
{
    use HasFactory, Sortable;


    protected $fillable = [
        'name',
        'description'
    ];

    protected $sortable = [
        'name',
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

    public function detailValues()
    {
        return $this->hasMany(DetailMasterValue::class);
    }


}
