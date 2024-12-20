<?php $pages = (int) ceil($all / $limit); ?>

<?php for ($page = 1; $page <= $pages; $page++): ?>
  <?php if ($page === $current): ?>
  <span><?= $page; ?></span>
  <?php else: ?>
  <a href="/admin/complexes/page/<?= $page; ?>"><?= $page; ?></a>
  <?php endif; ?>
<?php endfor; ?>


