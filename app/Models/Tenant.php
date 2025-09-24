<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
        'flat_id',
        'name',
        'email',
        'phone',
        'move_in_date',
        'move_out_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'move_in_date' => 'date',
        'move_out_date' => 'date',
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
}
