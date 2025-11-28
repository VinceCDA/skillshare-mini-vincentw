<?php

namespace App\Entity;

use App\Repository\UserSkillWantedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSkillWantedRepository::class)]
class UserSkillWanted
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userSkillWanteds')]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'userSkillWanteds')]
    private ?skill $skill = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSkill(): ?skill
    {
        return $this->skill;
    }

    public function setSkill(?skill $skill): static
    {
        $this->skill = $skill;

        return $this;
    }
}
