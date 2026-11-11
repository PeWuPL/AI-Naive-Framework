<?php

/** @var \App\Model\Book $book */
/** @var \App\Service\Router $router */

$e = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES);
$title = "{$e($book->getTitle())} ({$book->getId()})";
$bodyClass = 'show';

ob_start(); ?>
    <h1><?= $e($book->getTitle()) ?></h1>
    <dl>
        <dt>Author</dt><dd><?= $e($book->getAuthor()) ?></dd>
        <dt>Release date</dt><dd><?= $e($book->getReleaseDate()) ?></dd>
        <dt>Publisher</dt><dd><?= $e($book->getPublisher()) ?></dd>
        <dt>Pages</dt><dd><?= $e($book->getPages()) ?></dd>
    </dl>
    <article>
        <?= nl2br($e($book->getDescription())) ?>
    </article>

    <ul class="action-list">
        <li><a href="<?= $router->generatePath('book-index') ?>">Back to list</a></li>
        <li><a href="<?= $router->generatePath('book-edit', ['id' => $book->getId()]) ?>">Edit</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
