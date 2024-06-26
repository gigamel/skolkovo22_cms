<?php
/** @var \Throwable $e */
if (!is_object($e ?? null)) {
    return;
}

if (!$e instanceof \Throwable) {
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Page Throwable</title>
        <meta charset="UTF-8"/>
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            body {
                background-color: #111;
                font-family: sans-serif;
                color: #7f3a7d;
                font-size: 20px;
            }
            h1 {
                background-color: #7f3a7d;
                font-size: 32px;
                color: #ffffff;
                padding: 15px;
            }
            .content {
                padding: 15px;
            }
            p {
                padding: 15px 0;
            }
        </style>
    </head>
    <body>
        <h1>Oops!</h1>
        <div class="content">

            <p>
                <strong>Type:</strong>
                <?= get_class($e); ?>
            </p>
            <p>
                <strong>File:</strong>
                <?= sprintf('%s:%d', $e->getFile(), $e->getLine()); ?>
            </p>
            <p>
                <strong>Message:</strong>
                <?= $e->getMessage(); ?>
            </p>
            <pre><?php var_dump($e->getTrace()); ?></pre>
        </div>
    </body>
</html>
