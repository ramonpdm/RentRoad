<?php

namespace App\Seeders;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class BaseSeeder
{
    const array ORDER = [
        1 => RolSeeder::class,
        2 => SucursalSeeder::class,
        3 => UsuarioSeeder::class,
        4 => CategoriaVehiculoSeeder::class,
        5 => VehiculoSeeder::class,
        6 => ClienteSeeder::class,
        7 => RentaSeeder::class,
    ];

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

    public function getRepo(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}