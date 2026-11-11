<?php
namespace App\Model;

class Post extends Common
{
    private ?string $subject = null;
    private ?string $content = null;

    protected static function table(): string
    {
        return 'post';
    }

    protected static function columns(): array
    {
        return [
            'subject' => 'subject',
            'content' => 'content',
        ];
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): Post
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): Post
    {
        $this->content = $content;

        return $this;
    }
}
