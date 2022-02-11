<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SearchThemeRepository;


#[ApiResource(
    collectionOperations: [
        'post' => [
            'denormalization_context' => ['groups' => ["write:SearchTheme"]],
            'normalization_context' => ['groups' => ["read:SearchTheme"]]
        ],
        'get' => [
            'controller' => NotFoundAction::class,
            'read' => false,
            'output' => false,
            'openapi_context' => [
                'summary' => 'hidden'
            ]

        ]
    ],
    itemOperations: [
        'get' => [
            'controller' => NotFoundAction::class,
            'read' => false,
            'output' => false,
            'openapi_context' => [
                'summary' => 'hidden'
            ]

        ]
    ]

)]
class SearchTheme
{
    #[Groups(["read:SearchTheme"])]
    private $id;

    #[Groups(["read:SearchTheme", "write:SearchTheme"])]
    private $keyword;

    #[Groups(["read:SearchTheme", "write:SearchTheme"])]
    private $statusId;

    #[Groups(["read:SearchTheme"])]
    private $youtubeLinkId;

    #[Groups(["read:SearchTheme"])]
    private $authorId;

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
