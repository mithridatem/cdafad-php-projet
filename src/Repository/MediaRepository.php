<?php

namespace App\Repository;

use App\Entity\Entity;
use App\Entity\Media;
use App\Repository\AbstractRepository;

class MediaRepository extends AbstractRepository
{
    public function find(int $id): ?Entity
    {
        return new Media("","",new \DateTimeImmutable());
    }

    public function findAll(): array
    {
        return [];
    }

    public function save(Entity $entity): ?Entity
    {
        throw new \Exception('Not implemented');
    }
}