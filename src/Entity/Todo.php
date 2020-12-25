<?php

namespace App\Entity;

use App\Controller\TimeStamp;
use App\Repository\TodoRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TodoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Todo
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="todos")
     */
    private $membre;





    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private $termine;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="tache")
     */
    private $AssigneA;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMembre(): ?membre
    {
        return $this->membre;
    }

    public function setMembre(?membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }




    public function getTermine(): ?bool
    {
        return $this->termine;
    }

    public function setTermine(bool $termine): self
    {
        $this->termine = $termine;

        return $this;
    }

    public function getAssigneA(): ?Membre
    {
        return $this->AssigneA;
    }

    public function setAssigneA(?Membre $AssigneA): self
    {
        $this->AssigneA = $AssigneA;

        return $this;
    }


}
