<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentAsset extends Model
{
    use HasFactory;

    protected $table = 'rent_asset';
    protected $fillable = [
        'asset_id', 
        'rent_date', 
        'rent_due_date', 
        'used_by'
    ];
    
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
}
