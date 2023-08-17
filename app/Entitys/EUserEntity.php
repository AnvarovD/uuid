<?php

namespace App\Entitys;

use Carbon\Carbon;
use Illuminate\Support\Str;

class EUserEntity
{
    private ?Carbon $email_verified_at = null;

    private ?array $posts = null;

    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
        private ?string         $id = null
    )
    {
        $this->id = $id ?? Str::uuid()->toString();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->email_verified_at;
    }

    public function setEmailVerifiedAt(?Carbon $email_verified_at): self
    {
        $this->email_verified_at = $email_verified_at;
        return $this;
    }

    public function getPosts(): ?array
    {
        return $this->posts;
    }

    public function setPosts(?array $posts): void
    {
        $this->posts = $posts;
    }
    public function toDbArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'id' => $this->id
        ];
    }
}
