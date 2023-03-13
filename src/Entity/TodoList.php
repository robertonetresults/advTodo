<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\TodoListRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoListRepository::class)]
#[ApiResource(
    operations: [
        new Get(uriTemplate: '/todoLists/{id}'),
        new GetCollection(uriTemplate: '/todoLists'),
        new Post(uriTemplate: '/todoLists'),
        new Patch(uriTemplate: '/todoLists/{id}'),
        new Delete(uriTemplate: '/todoLists/{id}'),
    ],
    formats: ['json'],
    paginationEnabled: false,
)]
class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(example: 1)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[ApiProperty(example: 'Main TODO list')]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'todoList', targetEntity: PostIt::class, orphanRemoval: true)]
    #[ApiProperty(example: ['/api/postIts/1', '/api/postIts/2'])]
    private Collection $postIts;

    #[ORM\Column]
    private ?DateTimeImmutable $lastModified;

    public function __construct()
    {
        $this->postIts = new ArrayCollection();
        $this->lastModified = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, PostIt>
     */
    public function getPostIts(): Collection
    {
        return $this->postIts;
    }

//    public function addPostIt(PostIt $postIt): self
//    {
//        if (!$this->postIts->contains($postIt)) {
//            $this->postIts->add($postIt);
//            $postIt->setTodoList($this);
//        }
//
//        return $this;
//    }
//
//    public function removePostIt(PostIt $postIt): self
//    {
//        if ($this->postIts->removeElement($postIt)) {
//            // set the owning side to null (unless already changed)
//            if ($postIt->getTodoList() === $this) {
//                $postIt->setTodoList(null);
//            }
//        }
//
//        return $this;
//    }

    public function getLastModified(): ?DateTimeImmutable
    {
        return $this->lastModified;
    }
}
