<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'role',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var list<string>
     */
    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'role' => 'owner',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the buildings owned by the user.
     */
    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class, 'house_owner_id');
    }

    /**
     * Get the flats owned by the user.
     */
    public function flats(): HasManyThrough
    {
        return $this->hasManyThrough(Flat::class, Building::class, 'house_owner_id', 'building_id');
    }

    /**
     * Get the tenants associated with the user through buildings and flats.
     */
    public function tenants(): HasManyThrough
    {
        return $this->hasManyThrough(Tenant::class, Flat::class, 'house_owner_id', 'flat_id');
    }

    /**
     * Get the bills associated with the user through flats.
     */
    public function bills(): HasManyThrough
    {
        return $this->hasManyThrough(Bill::class, Flat::class, 'house_owner_id', 'flat_id');
    }

    /**
     * Get the bill categories associated with the user through bills.
     */
    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(BillCategory::class, Bill::class, 'house_owner_id', 'id', 'id', 'bill_category_id');
    }

    /**
     * Get the user's role.
     */
    public function getRoleAttribute(): string
    {
        return 'owner';
    }
}
