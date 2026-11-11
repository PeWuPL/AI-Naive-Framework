<?php
    /** @var $book ?\App\Model\Book */
    $e = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES);
?>

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="book[title]" value="<?= $e($book?->getTitle()) ?>">
</div>

<div class="form-group">
    <label for="author">Author</label>
    <input type="text" id="author" name="book[author]" value="<?= $e($book?->getAuthor()) ?>">
</div>

<div class="form-group">
    <label for="release_date">Release date</label>
    <input type="date" id="release_date" name="book[release_date]" value="<?= $e($book?->getReleaseDate()) ?>">
</div>

<div class="form-group">
    <label for="publisher">Publisher</label>
    <input type="text" id="publisher" name="book[publisher]" value="<?= $e($book?->getPublisher()) ?>">
</div>

<div class="form-group">
    <label for="pages">Pages</label>
    <input type="number" min="0" id="pages" name="book[pages]" value="<?= $e($book?->getPages()) ?>">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="book[description]"><?= $e($book?->getDescription()) ?></textarea>
</div>

<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
