<?php

namespace App\Repository;

use App\Entity\Entity;
use App\Entity\Category;
use App\Repository\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    public function find(int $id): ?Category
    {
        return new Category("");
    }

    public function findAll(): array
    {
        return [];
    }

    public function save(Entity $entity): ?Category
    {
        try {
            //2 Ecrire la requête SQL
            $sql = "INSERT INTO category(`name`, created_at)
            VALUE (?,?)";
            //3 Préparer la requête
            $req = $this->connect->prepare($sql);
            //4 Assigner les paarmètres(bindParam)
            $req->bindValue(1, $entity->getName(), \PDO::PARAM_STR);
            $req->bindValue(2, $entity->getCreatedAt()->format('Y-m-d'), \PDO::PARAM_STR);
            //5 exécuter la requête
            $req->execute();
            //6 récupérer l'id
            $id = $this->connect->lastInsertId();
            $entity->setId($id);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur d'enregistrement");
        }
        return $entity;
    }

    public function isUserExists(string $name): bool
    {
        try {
            //2 Ecrire la requête SQL
            $sql = "SELECT c.id FROM category AS c WHERE c.name = ?";
            //3 Préparer la requête
            $req = $this->connect->prepare($sql);
            //4 Assigner les paarmètres(bindParam)
            $req->bindParam(1, $name, \PDO::PARAM_STR);
            //5 exécuter la requête
            $req->execute();
            //6 récupérer la réponse (SELECT)
            $category = $req->fetch();
            //Test si n'existe pas (tableau vide)
            if (empty($category)) {
                return false;
            }
        } catch (\Exception $e) {
            throw new \Exception("Erreur d'enregistrement");
        }
        return true;
    }
}
