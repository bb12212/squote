<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'last_name',
        'email',
        'phone',
        'password',
        'role',
        'preferred_contact_method',
        'region_id',
        'contact_name',
        'website',
        'company_name',
        'company_description',
        'services_offered',
        'certifications',
        'is_approved',
        'subscription_status',
        'subscription_ends_at',
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
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'boolean',
            'subscription_ends_at' => 'datetime',
        ];
    }

    /**
     * Check if the user is a provider.
     */
    public function isProvider(): bool
    {
        return $this->role === 'provider';
    }

    /**
     * Check if the user is a consumer.
     */
    public function isConsumer(): bool
    {
        return $this->role === 'consumer';
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the region that the user belongs to.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the regions that the provider serves.
     */
    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'provider_region')
            ->withPivot('is_preferred')
            ->withTimestamps();
    }

    /**
     * Get the properties that belong to the user.
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the leads that belong to the user.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get the leads assigned to the provider.
     */
    public function assignedLeads(): BelongsToMany
    {
        return $this->belongsToMany(Lead::class, 'lead_provider')
            ->withPivot('status', 'assigned_at', 'contacted_at')
            ->withTimestamps();
    }

    /**
     * Get the quotes submitted by the provider.
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    /**
     * Get the messages sent by the user.
     */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get the services that the provider offers.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'provider_service')
            ->withTimestamps();
    }
}
