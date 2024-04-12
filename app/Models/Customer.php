<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'observation',
    ];

    protected $appends = ['fullname'];

    public function getFullnameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function scopeFilter(Builder $query, string $value = null): Builder
    {
        return $query->when($value, function ($q, $v) {
            $q->where('first_name', 'like', "%{$v}%")->orWhere('last_name', 'like', "%{%$v}%");
        });
    }
}
