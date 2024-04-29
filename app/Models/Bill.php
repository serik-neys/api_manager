<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{

    use HasFactory;

    protected $fillable = [
        'usage_duration_in_ms',
        'cost_per_ms',
        'total',
        'api_token_id',
        'service_id',
        'workspace_id'
    ];

    public function api_token(): BelongsTo {
        return $this->belongsTo(ApiToken::class);
    }

    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }
}
