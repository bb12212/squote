<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'region_id',
        'postcode',
        'property_type',
        'roof_type',
        'roof_material',
        'has_significant_shading',
        'monthly_energy_bill',
        'annual_energy_usage',
        'additional_details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'has_significant_shading' => 'boolean',
        'monthly_energy_bill' => 'decimal:2',
        'annual_energy_usage' => 'integer',
    ];

    /**
     * Get the user that owns the property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the region that the property belongs to.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the leads for this property.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Property type options.
     */
    public static function propertyTypes(): array
    {
        return [
            'detached' => 'Detached House',
            'semi-detached' => 'Semi-Detached House',
            'terraced' => 'Terraced House',
            'apartment' => 'Apartment',
        ];
    }

    /**
     * Roof type options.
     */
    public static function roofTypes(): array
    {
        return [
            'pitched' => 'Pitched',
            'flat' => 'Flat',
            'mixed' => 'Mixed',
        ];
    }

    /**
     * Roof material options.
     */
    public static function roofMaterials(): array
    {
        return [
            'tile' => 'Tile',
            'slate' => 'Slate',
            'metal' => 'Metal',
            'asphalt' => 'Asphalt',
            'other' => 'Other',
        ];
    }
}
