<?php

namespace App\Entitys;

use Illuminate\Support\Str;

class EPostEntity
{
    private EUserEntity $userEntity;
    public function __construct(
        private readonly string $title,
        private readonly string $user_id,
        private ?string         $id = null
    )
    {
        $this->id = $id ?? Str::uuid()->toString();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUser(): EUserEntity
    {
        return $this->userEntity;
    }

    public function setUser(EUserEntity $userEntity): void
    {
        $this->userEntity = $userEntity;
    }

    public function toDbArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
        ];
    }
}
