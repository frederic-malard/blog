<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DessinRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *      fields = {"nom"},
 *      message = "Un autre dessin contient le même nom. Merci de le changer. Vérifiez aussi que vous avez entré un slug unique, ou vide. Si le slug est en double, ça engendrera un bug.")
 * @UniqueEntity(
 *      fields = {"url"},
 *      message = "Un autre dessin contient la même url, vous vous apprêtez à poster deux fois le même dessin. Merci de changer l'url.")
 * )
 */
class Dessin
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      min = 30,
     *      minMessage = "La légende doit faire au moins 30 caractères"
     * )
     */
    private $caption;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePublication;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategorieDessin", mappedBy="dessin")
     * @Assert\Valid
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentDrawing", mappedBy="drawing")
     */
    private $commentsDrawing;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RatingDrawing", mappedBy="drawing")
     */
    private $ratingDrawings;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $display;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->commentsDrawing = new ArrayCollection();
        $this->ratingDrawings = new ArrayCollection();
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
        if (empty($this->nom))
        {
            $this->nom = substr($this->url, 9, strlen($this->url)-13);
        }
        $this->slug = (new Slugify())->slugify($this->nom);
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

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

    public function getCaptionIntroduction(): ?string
    {
        if (strlen($this->caption) > 130)
        {
            $cut = 90;
            while (substr($this->caption, $cut, 1) != ' ' && $cut < 110)
            {
                $cut++;
            }
            return substr($this->caption, 0, $cut) . ' [...]';
        }
        else
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

    /**
     * le nom de la méthode est au singulier, mais renvoie une collection. Renvoie l'ensemble des catégories relatives à ce dessin !!!
     * 
     * @return Collection|CategorieDessin[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(CategorieDessin $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->addDessin($this);
        }

        return $this;
    }

    public function removeCategorie(CategorieDessin $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
            $categorie->removeDessin($this);
        }

        return $this;
    }

    /**
     * @return Collection|CommentDrawing[]
     */
    public function getCommentsDrawing(): Collection
    {
        return $this->commentsDrawing;
    }

    public function addCommentsDrawing(CommentDrawing $commentsDrawing): self
    {
        if (!$this->commentsDrawing->contains($commentsDrawing)) {
            $this->commentsDrawing[] = $commentsDrawing;
            $commentsDrawing->setDrawing($this);
        }

        return $this;
    }

    public function removeCommentsDrawing(CommentDrawing $commentsDrawing): self
    {
        if ($this->commentsDrawing->contains($commentsDrawing)) {
            $this->commentsDrawing->removeElement($commentsDrawing);
            // set the owning side to null (unless already changed)
            if ($commentsDrawing->getDrawing() === $this) {
                $commentsDrawing->setDrawing(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RatingDrawing[]
     */
    public function getRatingDrawings(): Collection
    {
        return $this->ratingDrawings;
    }

    public function addRatingDrawing(RatingDrawing $ratingDrawing): self
    {
        if (!$this->ratingDrawings->contains($ratingDrawing)) {
            $this->ratingDrawings[] = $ratingDrawing;
            $ratingDrawing->setDrawing($this);
        }

        return $this;
    }

    public function removeRatingDrawing(RatingDrawing $ratingDrawing): self
    {
        if ($this->ratingDrawings->contains($ratingDrawing)) {
            $this->ratingDrawings->removeElement($ratingDrawing);
            // set the owning side to null (unless already changed)
            if ($ratingDrawing->getDrawing() === $this) {
                $ratingDrawing->setDrawing(null);
            }
        }

        return $this;
    }

    public function getDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(?bool $display): self
    {
        $this->display = $display;

        return $this;
    }
}
