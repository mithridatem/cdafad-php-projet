<?php

namespace App\Entity;

class Media extends Entity
{
    private ?int $id;
    private string $url;
    private string $alt;
    private ?\DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt;

    public function __construct(
        ?string $url ="",
        ?string $alt = "",
        ?\DateTimeImmutable $createdAt = null
    )
    {
        $this->url = $url;
        $this->alt = $alt;
        $this->createdAt = $createdAt;
    }

    public function getId():?int
    {
        return $this->id;
    }

    public function setId(int $id):self
    {
        $this->id = $id;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function __set($name, $value)
    {
        if ($name == "created_at") {
            $this->createdAt = new \DateTimeImmutable($value);
        }
    }

    public function __serialize(): array
    {
        return [
            "id"=> isset($this->id) ? $this->id : null,
            "url"=> $this->url,
            "alt"=> $this->alt,
            "alt"=> $this->alt,
            "createdAt" => isset($this->createdAt)
                ? $this->createdAt->format("Y-m-d H:i:s")
                : null,
            "updatedAt" => isset($this->updatedAt)
                ? $this->updatedAt?->format("Y-m-d H:i:s")
                : null,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->url = $data['url'];
        $this->alt = $data['alt'];
        $this->setCreatedAt($data['created_at']);
        $this->setUpdatedAt($data['created_at']);
    }
}
