<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    public const ADMINISTRATOR = 'administrator';

    public const MODERATOR = 'moderator';

    public const COMMERCIAL = 'commercial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function rolePermissions(): array
    {
        return [
            'read:products', 'create:products', 'update:products', 'delete:products',
            'read:images', 'create:images', 'update:images', 'delete:images',
            'read:categories', 'create:categories', 'update:categories', 'delete:categories',
        ];
    }

    public static function administratorPermissions(): array
    {
        return self::rolePermissions();
    }

    public static function moderatorPermissions(): array
    {
        return [
            'read:products', 'create:products', 'update:products',
            'read:images', 'create:images', 'update:images',
            'read:categories', 'create:categories', 'update:categories',
        ];
    }

    public static function commercialPermissions(): array
    {
        return [
            'read:products',
            'read:images',
            'read:categories',
        ];
    }
}
