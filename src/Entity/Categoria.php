<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Categoria
{    
    private string $id;
    private string $name;
    private string $idPage;    
    private string $path;        
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(string $name, string $idPage, string $path)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->idPage = $idPage;                
        $this->path = $path;                
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setIdPage(string $idPage): void
    {
        $this->idPage = $idPage;
    }

    public function getIdPage(): string
    {
        return $this->idPage;
    }
    
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }        
}
