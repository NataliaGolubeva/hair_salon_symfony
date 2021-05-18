<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;
    /**
     * @ORM\OneToMany(targetEntity="ServiceList", mappedBy="category")
     */
private $servicelists;

public function __construct()
{
    $this->servicelists = new ArrayCollection();
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ServiceList[]
     */
    public function getServicelists(): Collection
    {
        return $this->servicelists;
    }

    public function addServicelist(ServiceList $servicelist): self
    {
        if (!$this->servicelists->contains($servicelist)) {
            $this->servicelists[] = $servicelist;
            $servicelist->setCategory($this);
        }

        return $this;
    }

    public function removeServicelist(ServiceList $servicelist): self
    {
        if ($this->servicelists->removeElement($servicelist)) {
            // set the owning side to null (unless already changed)
            if ($servicelist->getCategory() === $this) {
                $servicelist->setCategory(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->title;
    }
}
