<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationChangedSim extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'installation_id',
        'changed_sim_id',
        'new_sim_id',
        'sim_amount',
        'installation_amount',
        'additional_amount',
        'remark',
        'total_amount',
        'status',
    ];
}
