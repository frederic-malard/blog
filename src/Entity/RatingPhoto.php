<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingPhotoRepository")
 */
class RatingPhoto extends Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Photos", inversedBy="ratingPhotos")
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?Photos
    {
        return $this->photo;
    }

    public function setPhoto(?Photos $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
