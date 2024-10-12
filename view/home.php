<nav>
  <a href="/">Home</a>
  <a href="/contacts/">Contacts</a>
</nav>

<hr/>

<h1>Skolkovo22 CMS 2.0</h1>

<?php if ($posts): ?>

  <?php foreach ($posts as $post): ?>
  <div class="post-item">
    <h3><?= $post->title; ?></h3>
    <p><?= $post->summary; ?></p>
    <a href="/blog/post/<?= $post->id; ?>">More</a>
  </div>
  <hr />
  <?php endforeach; ?>

<?php else: ?>

<p>Posts list is empty</p>

<?php endif; ?>
