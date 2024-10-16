<?php require_once __DIR__ . '/tmp/header.php'; ?>

<div class="post">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1><?= $post->title; ?></h1>
        <p><?= $post->summary; ?></p>
        <p><em>&copy; Author Aleksey Sh.</em></p>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/tmp/footer.php'; ?>
