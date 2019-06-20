<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingTexteRepository")
 */
class RatingTexte extends Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Texte", inversedBy="ratingTextes")
     */
    private $texte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?Texte
    {
        return $this->texte;
    }

    public function setTexte(?Texte $texte): self
    {
        $this->texte = $texte;

        return $this;
    }
}
