<?php

namespace App\Seeders;

use Doctrine\ORM\EntityManagerInterface;

class BaseSeeder
{
    protected EntityManagerInterface $entityManager;
    protected string $className;

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
        foreach ($this->data() as $data) {
            $entity = new $this->className();
            foreach ($data as $column => $value) {
                if (!property_exists($entity, $column)) {
                    continue;
                }

                $entity->{$column} = $value;
            }
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }
}