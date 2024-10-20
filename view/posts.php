<div class="posts">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Sklkv22 CMS 2.0</h1>
      </div>
    </div>
    <div class="row">
    <?php if ($posts): ?>

      <?php foreach ($posts as $post): ?>
      <div class="col-3">
        <div class="post-item">
          <h3><?= $post->title; ?></h3>
          <p><?= $post->summary; ?></p>
          <a href="/blog/post/<?= $post->id; ?>">More</a>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="col-12">
        <hr />
        <?= widget('\\App\\Widget\\Page\\Pagination')->render('default.php', ['page' => $page, 'all' => $all, 'limit' => $limit]); ?>
      </div>

      <?php else: ?>
        <div class="col-12">
          <p>Posts list is empty</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
