<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCategoryReport extends Model
{
    use HasFactory;
    protected $table = 'm_category_report';

    protected $fillable = [
        'category_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
