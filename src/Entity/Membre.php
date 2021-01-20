<?php

namespace App\Entity;

use App\Controller\TimeStamp;
use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Membre
{
    use TimeStamp;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;




    /**
     * @ORM\ManyToOne(targetEntity=Famille::class, inversedBy="membres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $famille;

    /**
     * @ORM\OneToMany(targetEntity=Todo::class, mappedBy="membre")
     */
    private $todos;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="membre")
     */
    private $achats;



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pathcover;

    /**
     * @ORM\OneToMany(targetEntity=Todo::class, mappedBy="AssigneA")
     */
    private $tache;

    /**
     * @ORM\OneToOne(targetEntity=TypeMembre::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rolefamille;

    public function __construct()
    {
        $this->todos = new ArrayCollection();
        $this->achats = new ArrayCollection();
        $this->tache = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }



    public function getFamille(): ?famille
    {
        return $this->famille;
    }

    public function setFamille(?famille $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * @return Collection|Todo[]
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    public function addTodo(Todo $todo): self
    {
        if (!$this->todos->contains($todo)) {
            $this->todos[] = $todo;
            $todo->setMembre($this);
        }

        return $this;
    }

    public function removeTodo(Todo $todo): self
    {
        if ($this->todos->removeElement($todo)) {
            // set the owning side to null (unless already changed)
            if ($todo->getMembre() === $this) {
                $todo->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Achat[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setMembre($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getMembre() === $this) {
                $achat->setMembre(null);
            }
        }

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPathcover(): ?string
    {
        return $this->pathcover;
    }

    public function setPathcover(?string $pathcover): self
    {
        $this->pathcover = $pathcover;

        return $this;
    }

    /**
     * @return Collection|Todo[]
     */
    public function getTache(): Collection
    {
        return $this->tache;
    }

    public function addTache(Todo $tache): self
    {
        if (!$this->tache->contains($tache)) {
            $this->tache[] = $tache;
            $tache->setAssigneA($this);
        }

        return $this;
    }

    public function removeTache(Todo $tache): self
    {
        if ($this->tache->removeElement($tache)) {
            // set the owning side to null (unless already changed)
            if ($tache->getAssigneA() === $this) {
                $tache->setAssigneA(null);
            }
        }

        return $this;
    }

    public function getRolefamille(): ?TypeMembre
    {
        return $this->rolefamille;
    }

    public function setRolefamille(TypeMembre $rolefamille): self
    {
        $this->rolefamille = $rolefamille;

        return $this;
    }
}
