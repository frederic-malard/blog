<?php

namespace App\Entity;

use App\Entity\Comment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentTexteRepository")
 */
class CommentTexte extends Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Texte", inversedBy="commentsTexte")
     */
    private $texte;

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
