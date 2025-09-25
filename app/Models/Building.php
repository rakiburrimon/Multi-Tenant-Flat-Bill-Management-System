<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Builder;

class Building extends Model
{
    /** @use HasFactory<\Database\Factories\BuildingFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'house_owner_id',
        'name',
        'address',
        'city',
        'postcode',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the owner of the building.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'house_owner_id');
    }

    /**
     * Get the flats for the building.
     */
    public function flats(): HasMany
    {
        return $this->hasMany(Flat::class);
    }

    /**
     * Get the tenants for the building through flats.
     */
    public function tenants(): HasManyThrough
    {
        return $this->hasManyThrough(Tenant::class, Flat::class);
    }

    /**
     * Get the bills for the building through flats.
     */
    public function bills(): HasManyThrough
    {
        return $this->hasManyThrough(Bill::class, Flat::class);
    }

    /**
     * Get the bill categories associated with the building through bills.
     */
    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(BillCategory::class, Bill::class, 'flat_id', 'id', 'id', 'bill_category_id');
    }

    /**
     * Scope: records for a specific house owner.
     */
    public function scopeForOwner(Builder $query, int $ownerId): Builder
    {
        return $query->where('house_owner_id', $ownerId);
    }
}
