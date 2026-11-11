<?php
namespace App\Model;

class Book extends Common
{
    private ?string $author = null;
    private ?string $title = null;
    private ?string $releaseDate = null;
    private ?string $publisher = null;
    private ?int $pages = null;
    private ?string $description = null;

    protected static function table(): string
    {
        return 'book';
    }

    protected static function columns(): array
    {
        return [
            'author' => 'author',
            'title' => 'title',
            'release_date' => 'releaseDate',
            'publisher' => 'publisher',
            'pages' => 'pages',
            'description' => 'description',
        ];
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): Book
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Book
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?string $releaseDate): Book
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(?string $publisher): Book
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(?int $pages): Book
    {
        $this->pages = $pages;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Book
    {
        $this->description = $description;

        return $this;
    }
}
