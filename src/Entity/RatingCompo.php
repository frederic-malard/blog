<?php

namespace App\Entity;

use App\Entity\Rating;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingCompoRepository")
 */
class RatingCompo extends Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compos", inversedBy="ratingCompos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompo(): ?Compos
    {
        return $this->compo;
    }

    public function setCompo(?Compos $compo): self
    {
        $this->compo = $compo;

        return $this;
    }
}
