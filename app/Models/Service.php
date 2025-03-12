<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_active',
        'display_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Get the leads that belong to this service.
     */
    public function leads(): BelongsToMany
    {
        return $this->belongsToMany(Lead::class, 'lead_service')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        // Try with boolean true first
        try {
            return $query->where('is_active', true);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('Error in scopeActive with boolean: '.$e->getMessage());

            // Try with integer 1 as a fallback
            try {
                return $query->whereRaw('is_active = 1');
            } catch (\Exception $e2) {
                // Log the error
                \Illuminate\Support\Facades\Log::error('Error in scopeActive with integer: '.$e2->getMessage());

                // Return the original query as a last resort
                return $query;
            }
        }
    }

    /**
     * Scope a query to order by display order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
