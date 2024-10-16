<?php if ($all > $limit): ?>
  <?php for($num = 1; $num < ((int)ceil($all / $limit)) + 1; $num++): ?>
    <?php if ($page === $num): ?>
    <span><?= $num; ?></span>
    <?php else: ?>
    <a href="/blog/page/<?= $num; ?>"><?= $num; ?></a>
    <?php endif; ?>
  <?php endfor; ?>
<?php endif; ?>
