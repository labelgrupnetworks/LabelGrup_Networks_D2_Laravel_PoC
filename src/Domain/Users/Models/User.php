<?php

namespace Domain\Users\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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

    public array $allowedSorts = ['name', 'email'];

    // Resource functions
    public function fields(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created-at' => $this->created_at->format('d-m-Y'),
            'updated-at' => $this->updated_at->format('d-m-Y'),
        ];
    }

    public function createAuthToken(): string
    {
        return $this->createToken('auth_token')->plainTextToken;
    }

    // Model functions
    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    // SCOPES
    public function scopeName(Builder $query, $value)
    {
        $query->orWhere('name', 'LIKE', "%$value%");
    }

    public function scopeEmail(Builder $query, $value)
    {
        $query->orWhere('email', 'LIKE', "%$value%");
    }

}
