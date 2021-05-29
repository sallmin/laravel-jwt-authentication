<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The constants associated with the model.
     */
    public const TYPE_EMPLOYEE = 1;
    public const TYPE_PARTNER  = 5;
    public const TYPE_SUPER_ADMIN  = 10;

    public const LANGUAGE_GERMAN = 'DE';
    public const LANGUAGE_FRENCH = 'FR';
    public const LANGUAGE_ITALIAN = 'IT';
    public const LANGUAGE_ENGLISH = 'EN';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'language',
        'email',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Check if user is super admin
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
         return $this->type === self::TYPE_SUPER_ADMIN;
    }

    /**
     * Check if user is partner
     *
     * @return bool
     */
    public function isPartner(): bool
    {
        return $this->type === self::TYPE_PARTNER;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Fetch user leads
     *
     * @return hasMany
     */
    public function leads(): hasMany
    {
        return $this->hasMany(Lead::class)->with('client')->where('status', Lead::STATUS_COMPLETED)->latest();
    }

    /**
     * Return user role
     *
     */
    public function getRole()
    {
        return $this->type == self::TYPE_SUPER_ADMIN ? 'ADMIN' : ($this->type == self::TYPE_EMPLOYEE ? 'EMPLOYEE' : 'PARTNER');
    }

    /**
     * Check if authenticated user with role Partner can access particular partner
     *
     * @param $partnerId
     * @return bool
     */
    public function canAccessPartner($partnerId): bool
    {
        return $this->isPartner() && PartnerUser::where('user_id', $this->id)->where('partner_id', $partnerId)->exists();
    }

    /**
     * Check number of leads for authenticated user
     *
     * @return integer
     */
    public function totalLeads(): int
    {
        return $this->leads()->count();
    }

    /**
     * Return user partners
     *
     */
    public function partners(): belongsToMany
    {
        return $this->belongsToMany(Partner::class, 'partner_users', 'user_id', 'partner_id')
            ->where('active', true)
            ->orderBy('name');
    }
}
