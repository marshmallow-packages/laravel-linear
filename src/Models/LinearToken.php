<?php

namespace LaravelLinear\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LinearToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAuthDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function getAuthExpiresAttribute()
    {
        return Carbon::parse($this->expires_at)->format('d-m-Y');
    }
}
