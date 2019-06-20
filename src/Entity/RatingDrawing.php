<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingDrawingRepository")
 */
class RatingDrawing extends Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dessin", inversedBy="ratingDrawings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $drawing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDrawing(): ?Dessin
    {
        return $this->drawing;
    }

    public function setDrawing(?Dessin $drawing): self
    {
        $this->drawing = $drawing;

        return $this;
    }
}
