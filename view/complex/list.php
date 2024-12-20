<h1>Complexes</h1>

<?php if (empty($complexes)): ?>
  <p>Empty list.</p>
<?php else: ?>
  <table class="table">
    <?php foreach ($complexes as $complex): ?>
    <tr>
      <td><?= $complex->id; ?></td>
      <td><?= $complex->title; ?></td>
      <td>
        <a href="/admin/complex/edit/<?= $complex->id; ?>?from=<?= $currentPath; ?>" class="btn btn-primary">edit</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?= $widget->build('App\\Widget\\Pagination\\Widget')->render(
      'default.php',
      [
          'limit' => $limit ?? 3,
          'all' => $all,
          'current' => $currentPage,
      ]
  ); ?>
<?php endif; ?>
