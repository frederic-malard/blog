<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieDessinRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CategorieDessin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dessin")
     */
    private $representant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Dessin", inversedBy="categorie")
     */
    private $dessin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * prepare before persist and update
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prepare()
    {
        $this->slug = (new Slugify)->slugify($this->name);
    }

    public function __construct()
    {
        //$this->representant = new ArrayCollection();
        $this->dessin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRepresentant(): ?Dessin
    {
        return $this->representant;
    }

    public function setRepresentant(?Dessin $representant): self
    {
        $this->representant = $representant;

        return $this;
    }

    /**
     * @return Collection|Dessin[]
     */
    public function getDessin(): Collection
    {
        return $this->dessin;
    }

    public function addDessin(Dessin $dessin): self
    {
        if (!$this->dessin->contains($dessin)) {
            $this->dessin[] = $dessin;
        }

        return $this;
    }

    public function removeDessin(Dessin $dessin): self
    {
        if ($this->dessin->contains($dessin)) {
            $this->dessin->removeElement($dessin);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
