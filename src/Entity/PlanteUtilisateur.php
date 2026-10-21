<?php

namespace App\Entity;

use App\Repository\PlanteUtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanteUtilisateurRepository::class)]
class PlanteUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'planteUtilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'planteUtilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plante $plante = null;

    #[ORM\Column(length: 255)]
    private ?string $surnom = null;

    #[ORM\Column(length: 255)]
    private ?string $photo_personnelle = null;

    #[ORM\Column]
    private ?\DateTime $date_ajout = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $desactive_le = null;

    /**
     * @var Collection<int, Publication>
     */
    #[ORM\OneToMany(targetEntity: Publication::class, mappedBy: 'plante_utilisateur')]
    private Collection $publications;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getPlante(): ?Plante
    {
        return $this->plante;
    }

    public function setPlante(?Plante $plante): static
    {
        $this->plante = $plante;

        return $this;
    }

    public function getSurnom(): ?string
    {
        return $this->surnom;
    }

    public function setSurnom(string $surnom): static
    {
        $this->surnom = $surnom;

        return $this;
    }

    public function getPhotoPersonnelle(): ?string
    {
        return $this->photo_personnelle;
    }

    public function setPhotoPersonnelle(string $photo_personnelle): static
    {
        $this->photo_personnelle = $photo_personnelle;

        return $this;
    }

    public function getDateAjout(): ?\DateTime
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTime $date_ajout): static
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

    public function getDesactiveLe(): ?\DateTime
    {
        return $this->desactive_le;
    }

    public function setDesactiveLe(?\DateTime $desactive_le): static
    {
        $this->desactive_le = $desactive_le;

        return $this;
    }

    /**
     * @return Collection<int, Publication>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): static
    {
        if (!$this->publications->contains($publication)) {
            $this->publications->add($publication);
            $publication->setPlanteUtilisateurId($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): static
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getPlanteUtilisateurId() === $this) {
                $publication->setPlanteUtilisateurId(null);
            }
        }

        return $this;
    }
}
