<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCategoryAsset extends Model
{
    use HasFactory;
    protected $table = 'm_category_asset';

    protected $fillable = [
        'category_name_asset'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
