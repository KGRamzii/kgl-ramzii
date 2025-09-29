<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'business_name',
        'email',
        'phone',
        'monthly_rate',
        'notes',
        'status',
        'recurring', // true for monthly invoices, false for one-off
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('custom_price', 'active')
            ->withTimestamps();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
