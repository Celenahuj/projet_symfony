<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null; // Celui-ci peut rester obligatoire si vous l'initialisez dans le constructeur

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cgu_validated_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $verified_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $inactivated_at = null;

    /**
     * @var Collection<int, PlanteUtilisateur>
     */
    #[ORM\OneToMany(targetEntity: PlanteUtilisateur::class, mappedBy: 'utilisateur_id')]
    private Collection $planteUtilisateurs;

    /**
     * @var Collection<int, Publication>
     */
    #[ORM\OneToMany(targetEntity: Publication::class, mappedBy: 'utilisateur_id')]
    private Collection $publications;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'utilisateur_id')]
    private Collection $commentaires;

    public function __construct()
    {
        $this->planteUtilisateurs = new ArrayCollection();
        $this->publications = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);
        
        return $data;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCguValidatedAt(): ?\DateTimeImmutable
    {
        return $this->cgu_validated_at;
    }

    public function setCguValidatedAt(\DateTimeImmutable $cgu_validated_at): static
    {
        $this->cgu_validated_at = $cgu_validated_at;

        return $this;
    }

    public function getVerifiedAt(): ?\DateTimeImmutable
    {
        return $this->verified_at;
    }

    public function setVerifiedAt(\DateTimeImmutable $verified_at): static
    {
        $this->verified_at = $verified_at;

        return $this;
    }

    public function getInactivatedAt(): ?\DateTimeImmutable
    {
        return $this->inactivated_at;
    }

    public function setInactivatedAt(\DateTimeImmutable $inactivated_at): static
    {
        $this->inactivated_at = $inactivated_at;

        return $this;
    }

    /**
     * @return Collection<int, PlanteUtilisateur>
     */
    public function getPlanteUtilisateurs(): Collection
    {
        return $this->planteUtilisateurs;
    }

    public function addPlanteUtilisateur(PlanteUtilisateur $planteUtilisateur): static
    {
        if (!$this->planteUtilisateurs->contains($planteUtilisateur)) {
            $this->planteUtilisateurs->add($planteUtilisateur);
            $planteUtilisateur->setUtilisateur($this);
        }

        return $this;
    }

    public function removePlanteUtilisateur(PlanteUtilisateur $planteUtilisateur): static
    {
        if ($this->planteUtilisateurs->removeElement($planteUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($planteUtilisateur->getUtilisateur() === $this) {
                $planteUtilisateur->setUtilisateur(null);
            }
        }

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
            $publication->setUtilisateur($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): static
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getUtilisateur() === $this) {
                $publication->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUtilisateur() === $this) {
                $commentaire->setUtilisateur(null);
            }
        }

        return $this;
    }
}
