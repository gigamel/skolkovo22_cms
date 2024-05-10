<?php /** @var \App\Framework\Visual\ThemeInterface $this */ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $this->getTitle(); ?></title>
    <meta charset="UTF-8"/>
  </head>
  <body>
    <?php echo $this->getContent(); ?>
    <?php $this->includeJsCodeFromFile(__DIR__ . '/assets/jquery.js'); ?>
  </body>
</html>
