<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'house_owner_id',
        'flat_id',
        'tenant_id',
        'bill_category_id',
        'amount',
        'due_date',
        'status',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     *  Get the house owner of the bill.
     */
    public function houseOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'house_owner_id');
    }

    /**
     * Get the flat associated with the bill.
     */
    public function flat(): BelongsTo
    {
        return $this->belongsTo(Flat::class);
    }

    /**
     * Get the tenant associated with the bill.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the category associated with the bill.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BillCategory::class, 'category_id');
    }
}
