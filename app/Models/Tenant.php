<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Builder;

class Tenant extends Model
{
    /** @use HasFactory<\Database\Factories\TenantFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'house_owner_id',
        'flat_id',
        'name',
        'email',
        'phone',
        'lease_start',
        'lease_end',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lease_start' => 'date',
        'lease_end' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the flat associated with the tenant.
     */
    public function flat(): BelongsTo
    {
        return $this->belongsTo(Flat::class);
    }

    /**
     * Get the bills for the tenant.
     */
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * Get the owner of the tenant's flat.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'house_owner_id');
    }

    /**
     * Get the bill categories associated with the tenant through bills.
     */
    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(BillCategory::class, Bill::class, 'tenant_id', 'id', 'id', 'bill_category_id');
    }

    /**
     * Scope: limit tenants to an owner.
     */
    public function scopeForOwner(Builder $query, int $ownerId): Builder
    {
        return $query->where('house_owner_id', $ownerId);
    }
}
