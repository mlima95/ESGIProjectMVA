<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    collectionOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN')",
            "security_message" => "You are not admin",
            'normalization_context' => ['groups' => ["read:User"]]
        ],
        'post' => [
            "security" => "is_granted('ROLE_ADMIN')",
            "security_message" => "You are not admin",
            'denormalization_context' => ['groups' => ["write:User"]],
            'normalization_context' => ['groups' => ["read:User"]]

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
        'delete' => [
            "security" => "is_granted('ROLE_ADMIN')",
            "security_message" => "You are not admin"
        ]
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[ApiProperty(identifier: false)]
    private int $id;

    #[Groups(["read:User"])]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ApiProperty(identifier: true)]
    private string $uuid;

    #[Groups(["read:User", "write:User"])]
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $username;

    #[Groups(["write:User"])]
    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    #[Groups(["read:User", "write:User"])]
    #[ORM\Column(type: 'json')]
    private array $roles = [];


    public function __construct()
    {
        $this->uuid = Uuid::uuid4()->toString();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

}


/**
 * TODO G??rer le hash de Password avec un subscriber (apparament
 * Tester la cr??ation et la suppression
 * Soumettre le role de l'user ?? la cr??ation
 * D??velopper (#prendre depuis le net ou g??n??rer) les vues de login et de "CRUD"
 * Note : ne pas oublier de stocker le JWT
 *
 */
