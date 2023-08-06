<?php

namespace App\Models;

use App\Models\MCategoryReport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportTrouble extends Model
{
    use HasFactory;
    protected $table = 'report_trouble';

    protected $fillable = [
        'category_report_id',
        'report_detail',
        'report_pict',
        'report_by',
        // 'handle_by',
        // 'isdone',
    ];

    protected $casts = [
        'isdone' => 'boolean',
    ];

    public function report()
    {
        return $this->belongsTo(MCategoryReport::class, 'category_report_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'report_by');
    }

    public function handler()
    {
        return $this->belongsTo(User::class, 'handle_by');
    }

    // protected function report_pict(): Attribute
    // {
    //     // if($image == ''){
    //     //     return '';
    //     // }else{
    //     //     return Attribute::make(
    //     //         get: fn ($image) => asset('/storage/candidate/' . $image),
    //     //     );
    //     // }
    //     return Attribute::make(
    //         get: fn ($report_pict) => asset('/storage/' . $report_pict),
    //     );
    // }

}
