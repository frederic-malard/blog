<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComposRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Compos
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
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $caption;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $datePublication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentCompo", mappedBy="compo")
     */
    private $commentsCompo;

    public function __construct()
    {
        $this->commentsCompo = new ArrayCollection();
    }

    /**
     * prepare before update and persist
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function prepare()
    {
        if (empty($this->name))
        {
            $this->name = substr($this->url, 8, strlen($this->url) - 12);
        }
        if (empty($this->dateCreation))
        {
            $this->dateCreation = new \DateTime();
        }
        if (empty($this->datePublication))
        {
            $this->datePublication = new \DateTime();
        }
        if (empty($this->slug))
        {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->name);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
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

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

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

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function introduction()
    {
        if (strlen($this->caption) < 150)
        {
            return $this->caption;
        }
        else
        {
            return substr($this->caption, 0, 130) . "...";
        }
    }

    /**
     * @return Collection|CommentCompo[]
     */
    public function getCommentsCompo(): Collection
    {
        return $this->commentsCompo;
    }

    public function addCommentsCompo(CommentCompo $commentsCompo): self
    {
        if (!$this->commentsCompo->contains($commentsCompo)) {
            $this->commentsCompo[] = $commentsCompo;
            $commentsCompo->setCompo($this);
        }

        return $this;
    }

    public function removeCommentsCompo(CommentCompo $commentsCompo): self
    {
        if ($this->commentsCompo->contains($commentsCompo)) {
            $this->commentsCompo->removeElement($commentsCompo);
            // set the owning side to null (unless already changed)
            if ($commentsCompo->getCompo() === $this) {
                $commentsCompo->setCompo(null);
            }
        }

        return $this;
    }
}
