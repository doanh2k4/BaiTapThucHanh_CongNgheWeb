<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $fillable = [
        'computer_id',
        'reported_by',
        'reported_date',
        'urgency',
        'status',
    ];

    public function computer()
    {
        return $this->belongsTo(Computers::class);
    }
}
