<?php

namespace App\Repository;

use App\Repository\AbstractRepository;
use App\Entity\Entity;
use App\Entity\Media;

class MediaRepository extends AbstractRepository
{
    public function find(int $id): ?Media 
    {
        return null;
    }

    public function findAll(): array 
    {
        return [];
    }

    public function save(Entity $entity): Media
    {
        try {
            $sql = "INSERT INTO media(`url`, alt, created_at) VALUE(?,?,?)";
            $req = $this->connect->prepare($sql);
            $req->bindValue(1, $entity->getUrl(), \PDO::PARAM_STR);
            $req->bindValue(2, $entity->getAlt(), \PDO::PARAM_STR);
            $req->bindValue(3, $entity->getCreatedAt()->format('Y-m-d'), \PDO::PARAM_STR);
            $req->execute();
            $id = $this->connect->lastInsertId();
            $entity->setId($id);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
        return $entity;
    }
}