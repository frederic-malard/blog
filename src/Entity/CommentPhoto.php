<?php

namespace App\Entity;

use App\Entity\Comment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentPhotoRepository")
 */
class CommentPhoto extends Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Photos", inversedBy="commentsPhoto")
     */
    private $photo;

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
