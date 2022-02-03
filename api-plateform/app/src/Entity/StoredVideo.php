<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\DateTime;

#[ApiResource(
    collectionOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN')",
            "security_message" => "You are not admin",
            'normalization_context' => ['groups' => ["read:StoredVideo"]]
        ]
    ],
    itemOperations: ['get']
)]
class StoredVideo
{


    #[Groups(["read:StoredVideo"])]
    private string $id;

    #[Groups(["read:StoredVideo"])]
    private string $videoId;

    #[Groups(["read:StoredVideo"])]
    private DateTime $dateOfUpload;

    #[Groups(["read:StoredVideo"])]
    private int $status;


    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->videoId;
    }

    /**
     * @param string $videoId
     */
    public function setVideoId(string $videoId): void
    {
        $this->videoId = $videoId;
    }

    /**
     * @return DateTime
     */
    public function getDateOfUpload(): DateTime
    {
        return $this->dateOfUpload;
    }

    /**
     * @param DateTime $dateOfUpload
     */
    public function setDateOfUpload(DateTime $dateOfUpload): void
    {
        $this->dateOfUpload = $dateOfUpload;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }


}