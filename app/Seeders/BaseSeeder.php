<?php

namespace App\Seeders;

use Doctrine\ORM\EntityManagerInterface;

class BaseSeeder
{
    const int ORDER = 0;
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function data(): array
    {
        // TODO: Implementa el método data() para devolver los datos que
        //       insertaremos en la base de datos
        return [];
    }

    public function run(): void
    {
        foreach ($this->data() as $entity) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }

    public function getRepo(string $entityClass): \Doctrine\ORM\EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}