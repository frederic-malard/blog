<?php

namespace App\Entity;

use App\Entity\Comment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentCompoRepository")
 */
class CommentCompo extends Comment
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compos", inversedBy="commentsCompo")
     */
    private $compo;

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
