<h1>Complex #<?= $complex->id; ?></h1>

<?php if (isset($_GET['from'])): ?>
<p>
  <a href="<?= $_GET['from']; ?>">Back</a>
</p>
<?php endif; ?>

<form action="" method="POST" autocomplete="off">
  <div class="mb-3">
    <input type="text" class="form-control" name="title" placeholder="Title..." value="<?= $complex->title; ?>"/>
  </div>
  <div class="mb-3">
    <textarea class="form-control" name="description" placeholder="Description..."><?= $complex->description; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
