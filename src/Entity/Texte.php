<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TexteRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Texte
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $datePublication;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentTexte", mappedBy="texte")
     */
    private $commentsTexte;

    public function __construct()
    {
        $this->commentsTexte = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prepare()
    {
        $this->slug = (new Slugify())->slugify($this->name);

        if (empty($this->datePublication))
            $this->datePublication = new \DateTime();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function debut(): string
    {
        if (strlen($this->contenu) < 330)
            return $this->contenu;
        else
            return substr($this->contenu, 0, 300) . ' [...]</p>';
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function stringDateCreation(): ?string
    {
        return $this->dateCreation->format('d/m/Y');
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function stringDatePublication(): ?string
    {
        return $this->datePublication->format('d/m/Y');
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * @return Collection|CommentTexte[]
     */
    public function getCommentsTexte(): Collection
    {
        return $this->commentsTexte;
    }

    public function addCommentsTexte(CommentTexte $commentsTexte): self
    {
        if (!$this->commentsTexte->contains($commentsTexte)) {
            $this->commentsTexte[] = $commentsTexte;
            $commentsTexte->setTexte($this);
        }

        return $this;
    }

    public function removeCommentsTexte(CommentTexte $commentsTexte): self
    {
        if ($this->commentsTexte->contains($commentsTexte)) {
            $this->commentsTexte->removeElement($commentsTexte);
            // set the owning side to null (unless already changed)
            if ($commentsTexte->getTexte() === $this) {
                $commentsTexte->setTexte(null);
            }
        }

        return $this;
    }
}
