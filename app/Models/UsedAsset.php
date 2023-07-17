<?php

namespace App\Models;

use App\Models\User;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsedAsset extends Model
{
    use HasFactory;

    protected $table = 'used_asset';
    protected $fillable = [
        'asset_id',
        'used_by',
        'acc_by',
        'use_start_date',
    ];

    protected $casts = [
        'is_acc' => 'boolean',
    ];

    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by');
    }

    public function accBy()
    {
        return $this->belongsTo(User::class, 'acc_by');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
