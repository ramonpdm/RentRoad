<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\Table(name: 'roles')]
class Rol
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    public string $nombre;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $descripcion = null;
}