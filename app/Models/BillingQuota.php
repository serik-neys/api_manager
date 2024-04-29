<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'limit',
    ];

    public function workspace() {
        return $this->belongsTo(Workspace::class);
    }
}
