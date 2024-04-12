<?php

namespace App\Models;

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
}
