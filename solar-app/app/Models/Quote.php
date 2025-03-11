<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lead_id',
        'user_id',
        'provider_id',
        'total_amount',
        'description',
        'system_details',
        'system_size_kw',
        'estimated_annual_production_kwh',
        'estimated_savings_per_year',
        'warranty_years',
        'valid_until',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'system_size_kw' => 'integer',
        'estimated_annual_production_kwh' => 'integer',
        'estimated_savings_per_year' => 'decimal:2',
        'warranty_years' => 'integer',
        'valid_until' => 'date',
    ];

    /**
     * Get the lead that the quote belongs to.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the provider that owns the quote.
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    /**
     * Check if the quote is valid.
     */
    public function isValid(): bool
    {
        return $this->valid_until >= now() && $this->status === 'pending';
    }

    /**
     * Check if the quote is expired.
     */
    public function isExpired(): bool
    {
        return $this->valid_until < now();
    }

    /**
     * Check if the quote is accepted.
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    /**
     * Check if the quote is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Scope a query to only include pending quotes.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include accepted quotes.
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope a query to only include rejected quotes.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope a query to only include expired quotes.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }
}
