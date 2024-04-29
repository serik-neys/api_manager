<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function api_tokens() {
        return $this->hasMany(ApiToken::class);
    }

    public function billing_quota() {
        return $this->hasOne(BillingQuota::class);
    }
}
