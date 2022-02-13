<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Action\ApiProperty;
use App\Repository\SearchThemeRepository;


#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ["read:SearchTheme"]],
            'denormalization_context' => ['groups' => ["write:SearchTheme", "write:getSearchTheme"]],
        ],
        'post' => [
            'normalization_context' => ['groups' => ["read:SearchTheme"]],
            'denormalization_context' => ['groups' => ["write:SearchTheme"]]
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
        ],
        'patch' => [
            'normalization_context' => ['groups' => ["read:SearchTheme"]],
            'denormalization_context' => ['groups' => ["write:SearchTheme"]]
        ]
    ]

)]
class SearchTheme
{
    #[Groups(["read:SearchTheme"])]
    #[ApiProperty(identifier: true)]
    public $id;

    #[Groups(["read:SearchTheme", "write:SearchTheme"])]
    public $keyword;

    #[Groups(["read:SearchTheme", "write:SearchTheme"])]
    public $statusId;

    #[Groups(["read:SearchTheme", "write:getSearchTheme"])]
    public $youtubeLinkId;

    #[Groups(["read:SearchTheme", "write:getSearchTheme", "write:SearchTheme"])]
    public $authorId;

    #[Groups(["read:SearchTheme", "write:getSearchTheme", "write:SearchTheme"])]
    public $validatorId;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getStatusId(): ?string
    {
        return $this->statusId;
    }

    public function setStatusId(string $statusId): self
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

    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    public function setAuthorId(?string $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function getValidatorId(): ?string
    {
        return $this->validatorId;
    }

    public function setValidatorId(?string $validatorId): self
    {
        $this->validatorId = $validatorId;

        return $this;
    }
}
