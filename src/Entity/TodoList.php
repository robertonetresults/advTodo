<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TodoListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoListRepository::class)]
#[ApiResource]
class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'todoList', targetEntity: PostIt::class, orphanRemoval: true)]
    private Collection $postIts;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastModified = null;

    public function __construct()
    {
        $this->postIts = new ArrayCollection();
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

    public function addPostIt(PostIt $postIt): self
    {
        if (!$this->postIts->contains($postIt)) {
            $this->postIts->add($postIt);
            $postIt->setTodoList($this);
        }

        return $this;
    }

    public function removePostIt(PostIt $postIt): self
    {
        if ($this->postIts->removeElement($postIt)) {
            // set the owning side to null (unless already changed)
            if ($postIt->getTodoList() === $this) {
                $postIt->setTodoList(null);
            }
        }

        return $this;
    }

    public function getLastModified(): ?\DateTimeImmutable
    {
        return $this->lastModified;
    }

    public function setLastModified(\DateTimeImmutable $lastModified): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }
}
