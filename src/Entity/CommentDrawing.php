<?php

namespace App\Entity;

use App\Entity\Comment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentDrawingRepository")
 */
class CommentDrawing extends Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dessin", inversedBy="commentsDrawing")
     */
    private $drawing;

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
