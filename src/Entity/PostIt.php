<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\PostItRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostItRepository::class)]
#[ApiResource(
    operations: [
        new Get(uriTemplate: '/postIts/{id}'),
        new Post(uriTemplate: '/postIts', denormalizationContext: ['groups' => ['postIt:write']]),
        new Put(uriTemplate: '/postIts/{id}'),
        new Patch(uriTemplate: '/postIts/{id}'),
        new Delete(uriTemplate: '/postIts/{id}'),
    ],
    formats: ['json'],
    normalizationContext: ['groups' => ['postIt:read']],
    paginationEnabled: false,
)]
class PostIt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(example: 1)]
    #[Groups(['postIt:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[ApiProperty(example: 'Complete the jQuery course at ITS Prodigi')]
    #[Assert\NotBlank]
    #[Assert\Length(max: 1000)]
    #[Groups(['postIt:read', 'postIt:write'])]
    private ?string $note = null;

    #[ORM\Column(length: 32)]
    #[Assert\CssColor]
    #[Groups(['postIt:read', 'postIt:write'])]
    private ?string $color = '#ffff00';

    #[ORM\Column]
    #[ApiProperty(example: 'false')]
    #[ApiFilter(BooleanFilter::class)]
    #[Groups(['postIt:read'])]
    private ?bool $isDone = false;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(0)]
    #[Groups(['postIt:read'])]
    private ?int $position = 0;

    #[ORM\Column]
    #[Groups(['postIt:read'])]
    private ?DateTimeImmutable $lastModified;

    #[ORM\ManyToOne(inversedBy: 'postIts')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(example: 'api/todoLists/1')]
    #[Groups(['postIt:read', 'postIt:write'])]
    private ?TodoList $todoList = null;

    public function __construct()
    {
        $this->lastModified = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getLastModified(): ?DateTimeImmutable
    {
        return $this->lastModified;
    }

    public function getTodoList(): ?TodoList
    {
        return $this->todoList;
    }

    public function setTodoList(?TodoList $todoList): self
    {
        $this->todoList = $todoList;

        return $this;
    }
}
