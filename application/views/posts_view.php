<h2>Posts from JSON</h2>

<?php if (!empty($posts)): ?>

    <?php foreach ($posts as $post): ?>
        <p>
            <b><?= $post['id']; ?>.</b>
            <?= $post['title']; ?>
        </p>
    <?php endforeach; ?>

<?php else: ?>
    <p>No posts found</p>
<?php endif; ?>
