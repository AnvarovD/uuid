<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Entitys\EUserEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @class User
 * @property string $name
 * @property string $password
 * @property null|string $email_verified_at
 * @property string $email
 * @property Collection|Post[] posts
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $keyType = 'string';
    protected $guarded = [];

    public function toDomainEntity(): EUserEntity
    {
        $user = new EUserEntity(
            $this->name,
            $this->email,
            $this->password
        );

        if ($this->relations['posts']){
            $user->setPosts($this->posts->map->toDomainEntity()->toArray());
        }
        return $user;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
