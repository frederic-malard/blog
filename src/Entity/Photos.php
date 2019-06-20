<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotosRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *      fields = {"url"},
 *      message = "Une autre photo contient la même url, vous vous apprêtez à poster deux fois la même photo. Merci de changer l'url.")
 * )
 */
class Photos
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePublication;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentPhoto", mappedBy="photo")
     */
    private $commentsPhoto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RatingPhoto", mappedBy="photo")
     */
    private $ratingPhotos;

    public function __construct()
    {
        $this->commentsPhoto = new ArrayCollection();
        $this->ratingPhotos = new ArrayCollection();
    }

    /**
     * slugify from name
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
            $this->name = substr($this->url, 9, strlen($this->url)-12);
        }
        $this->slug = (new Slugify())->slugify($this->name);
        if (empty($this->datePublication))
        {
            $this->datePublication = (new \DateTime());
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

    public function setName(?string $name): self
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

    public function stringDateCreation()
    {
        return $this->dateCreation->format("d/m/Y");
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function stringDatePublication()
    {
        return $this->datePublication->format("d/m/Y");
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(?\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * @return Collection|CommentPhoto[]
     */
    public function getCommentsPhoto(): Collection
    {
        return $this->commentsPhoto;
    }

    public function addCommentsPhoto(CommentPhoto $commentsPhoto): self
    {
        if (!$this->commentsPhoto->contains($commentsPhoto)) {
            $this->commentsPhoto[] = $commentsPhoto;
            $commentsPhoto->setPhoto($this);
        }

        return $this;
    }

    public function removeCommentsPhoto(CommentPhoto $commentsPhoto): self
    {
        if ($this->commentsPhoto->contains($commentsPhoto)) {
            $this->commentsPhoto->removeElement($commentsPhoto);
            // set the owning side to null (unless already changed)
            if ($commentsPhoto->getPhoto() === $this) {
                $commentsPhoto->setPhoto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RatingPhoto[]
     */
    public function getRatingPhotos(): Collection
    {
        return $this->ratingPhotos;
    }

    public function addRatingPhoto(RatingPhoto $ratingPhoto): self
    {
        if (!$this->ratingPhotos->contains($ratingPhoto)) {
            $this->ratingPhotos[] = $ratingPhoto;
            $ratingPhoto->setPhoto($this);
        }

        return $this;
    }

    public function removeRatingPhoto(RatingPhoto $ratingPhoto): self
    {
        if ($this->ratingPhotos->contains($ratingPhoto)) {
            $this->ratingPhotos->removeElement($ratingPhoto);
            // set the owning side to null (unless already changed)
            if ($ratingPhoto->getPhoto() === $this) {
                $ratingPhoto->setPhoto(null);
            }
        }

        return $this;
    }
}
