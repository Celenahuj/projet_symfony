<?php

namespace App\Entity;

use App\Repository\PlanteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanteRepository::class)]
class Plante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $espece = null;

   #[ORM\Column(type: 'text')]
   private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $besoins_arrosage = null;

    #[ORM\Column(length: 255)]
    private ?string $besoins_lumiere = null;

    #[ORM\Column(length: 255)]
    private ?string $url_image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(string $espece): static
    {
        $this->espece = $espece;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBesoinsArrosage(): ?string
    {
        return $this->besoins_arrosage;
    }

    public function setBesoinsArrosage(string $besoins_arrosage): static
    {
        $this->besoins_arrosage = $besoins_arrosage;

        return $this;
    }

    public function getBesoinsLumiere(): ?string
    {
        return $this->besoins_lumiere;
    }

    public function setBesoinsLumiere(string $besoins_lumiere): static
    {
        $this->besoins_lumiere = $besoins_lumiere;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->url_image;
    }

    public function setUrlImage(string $url_image): static
    {
        $this->url_image = $url_image;

        return $this;
    }
}
