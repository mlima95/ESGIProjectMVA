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
        'get_search_themes' => [
            'method' => 'GET',
            'path' => 'search_themes/all',
            "security" => "is_granted('ROLE_ADMIN') || is_granted('ROLE_VALIDATOR')",
            "security_message" => "You are not admin",
            'normalization_context' => ['groups' => ["read:SearchTheme"]],
            'denormalization_context' => ['groups' => ["write:SearchTheme"]]
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
        ]
    ]

)]
class SearchTheme
{
    #[Groups(["read:SearchTheme"])]
    #[ApiProperty(identifier: false)]
    private $id;

    #[Groups(["read:SearchTheme", "write:SearchTheme"])]
    #[ApiProperty(identifier: true)]
    private $keyword;

    #[Groups(["read:SearchTheme", "write:SearchTheme"])]
    private $statusId;

    #[Groups(["read:SearchTheme", "write:getSearchTheme"])]
    private $youtubeLinkId;

    #[Groups(["read:SearchTheme"])]
    private $authorId;

    #[Groups(["read:SearchTheme"])]
    private $validatorId;

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
