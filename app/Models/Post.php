<?php

namespace App\Models;

use App\Entitys\EPostEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @class Post
 * @property string $title
 * @property string $user_id
 * @property string $id
 * @property User $user
 */
class Post extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $guarded = [];

    public function toDomainEntity(): EPostEntity
    {
        $post = new EPostEntity(
            $this->title,
            $this->user_id,
            $this->id
        );
        if (isset($this->relations['user'])) {
            $post->setUser($this->user->toDomainEntity());
        }

        return $post;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
