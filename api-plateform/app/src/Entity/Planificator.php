<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\DateTime;

#[ApiResource(
    collectionOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN') || is_granted('ROLE_VALIDATOR')",
            "security_message" => "You are not admin",
            'normalization_context' => ['groups' => ["read:Planificator"]]
        ],
        'post' => [
            "security" => "is_granted('ROLE_ADMIN') || is_granted('ROLE_VALIDATOR')",
            "security_message" => "You are not admin",
            'normalization_context' => ['groups' => ["read:Planificator"]],
            'denormalization_context' => ['groups' => ["write:Planificator"]]
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
class Planificator
{


    #[ApiProperty(identifier: true)]
    #[Groups(["read:Planificator", "write:Planificator"])]
    public string $youtubeSlug;

    #[Groups(["read:Planificator", "write:Planificator"])]
    public string $status;

    #[Groups(["read:Planificator", "write:Planificator"])]
    public $dateOfUpload;

    #[Groups(["read:Planificator", "write:Planificator"])]
    public string $userId;

    /**
     * @return string
     */
    public function getYoutubeSlug(): string
    {
        return $this->youtubeSlug;
    }

    /**
     * @param string $youtubeSLug
     */
    public function setYoutubeSlug(string $youtubeSlug): void
    {
        $this->youtubeSlug = $youtubeSlug;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return
     */
    public function getDateOfUpload()
    {
        return $this->dateOfUpload;
    }

    /**
     * @param $dateOfUpload
     */
    public function setDateOfUpload($dateOfUpload): void
    {
        $this->dateOfUpload = $dateOfUpload;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }


}