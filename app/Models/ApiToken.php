<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token',
        'workspace_id',
        'revoke'
    ];

    public function workspace(): BelongsTo {
        return $this->belongsTo(Workspace::class);
    }

    public function bills(): HasMany {
        return $this->hasMany(Bill::class, 'api_token_id');
    }
}
