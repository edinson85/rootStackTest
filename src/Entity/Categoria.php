<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Categoria
{    
    private string $id;
    private string $name;    
    private string $path; 
    private ?string $idPadre; 
    private ?Categoria $padre; 
    private ?Collection $subCategorias;      
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(string $name, string $path)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;        
        $this->path = $path;                
        $this->padre = null;                
        $this->idPadre = null;                
        $this->subCategorias = new ArrayCollection();
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
    
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPadre(Categoria $padre): void
    {
        $this->padre = $padre;
    }
    public function getPadre(): ?Categoria
    {
        return $this->padre;
    }
    public function setIdPadre(string $idPadre): void
    {
        $this->idPadre = $idPadre;
    }
    public function getIdPadre(): string
    {
        return $this->idPadre;
    }
    
    /**
     * @return Collection|Categoria[]
     */
    public function getSubCategorias(): Collection
    {
        return $this->subCategorias;
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
