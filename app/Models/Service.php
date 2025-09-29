<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'default_price',
        'active',
    ];

    protected $casts = [
        'default_price' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)
            ->withPivot('custom_price', 'active')
            ->withTimestamps();
    }

    public function getPriceForClient(Client $client): float
    {
        $clientService = $this->clients()->where('client_id', $client->id)->first();
        return $clientService ? $clientService->pivot->custom_price : $this->default_price;
    }
}
