<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SearchThemeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchThemeRepository::class)]
#[ApiResource(
    collectionOperations: [
        'post' => [
            'denormalization_context' => ['groups' => ["write:SearchTheme"]],
        ]
    ],
    itemOperations: [
        'get' => [
            'controller' => NotFoundAction::class,
            'read' => false,
            'output' => false,
        ]
    ]

)]
class SearchTheme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read:SearchTheme"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:SearchTheme"])]
    private $keyword;

    #[ORM\Column(type: 'integer')]
    #[Groups(["read:SearchTheme"])]
    private $statusId;

    #[ORM\Column(type: 'integer')]
    #[Groups(["read:SearchTheme"])]
    private $youtubeLinkId;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:SearchTheme"])]
    private $authorId;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[Groups(["read:SearchTheme"])]
    private $validatorId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): self
    {
        $this->statusId = $statusId;

        return $this;
    }

    public function getYoutubeLinkId(): ?int
    {
        return $this->youtubeLinkId;
    }

    public function setYoutubeLinkId(int $youtubeLinkId): self
    {
        $this->youtubeLinkId = $youtubeLinkId;

        return $this;
    }

    public function getAuthorId(): ?User
    {
        return $this->authorId;
    }

    public function setAuthorId(?User $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function getValidatorId(): ?User
    {
        return $this->validatorId;
    }

    public function setValidatorId(?User $validatorId): self
    {
        $this->validatorId = $validatorId;

        return $this;
    }
}
