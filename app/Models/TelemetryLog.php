<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelemetryLog extends Model
{
    use HasFactory;

    /**
     * The attributes that guarded.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];
}
