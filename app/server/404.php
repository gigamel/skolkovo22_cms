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
        <title>Page Not Found</title>
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
        </style>
    </head>
    <body>
        <h1>Page Not Found</h1>
        <div class="content">
            <p><?= $e->getMessage(); ?></p>
        </div>
    </body>
</html>
