<?php

namespace App\Models;

// use App\Models\User;
use App\Models\MCategoryAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'm_asset';

    protected $fillable = [
        'category_id',
        'asset_name',
        'asset_detail',
        'asset_pict',
        'used_by',
        'rent_by',
        'is_available'
    ];
    
    public function category()
    {
        return $this->belongsTo(MCategoryAsset::class, 'category_id');
    }

    public function rentedBy()
    {
        return $this->belongsTo(User::class, 'rent_by');
    }

    public function used_by()
    {
        return $this->belongsTo(User::class,'used_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'used_by');
    }
}
