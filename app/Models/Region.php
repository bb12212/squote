<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'postcode_pattern',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the providers that serve this region.
     */
    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'provider_region')
            ->withPivot('is_preferred')
            ->withTimestamps();
    }

    /**
     * Get the preferred providers for this region.
     */
    public function preferredProviders()
    {
        return $this->providers()->wherePivot('is_preferred', true);
    }

    /**
     * Get the users that belong to this region.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the properties in this region.
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Scope a query to only include active regions.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by name.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    /**
     * Check if a postcode belongs to this region.
     */
    public function matchesPostcode($postcode): bool
    {
        if (empty($this->postcode_pattern)) {
            return false;
        }

        return preg_match('/' . $this->postcode_pattern . '/i', $postcode) === 1;
    }
}
