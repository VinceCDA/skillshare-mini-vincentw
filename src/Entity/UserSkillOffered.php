<?php

namespace App\Entity;

use App\Repository\UserSkillOfferedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSkillOfferedRepository::class)]
class UserSkillOffered
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userSkillOffereds')]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'userSkillOffereds')]
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
