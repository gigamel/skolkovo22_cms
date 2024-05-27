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
                font-family: sans-serif;
                color: #333333;
                font-size: 20px;
            }
            h1 {
                background-color: #333333;
                font-size: 32px;
                color: #ffffff;
                padding: 15px;
            }
            .content {
                padding: 15px;
            }
            .container {
                margin: auto;
                max-width: 960px;
                padding: 30px 15px;
            }
            a {
                color: #bfbfbf;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Page Not Found</h1>
            <div class="content">
                <p><?= $e->getMessage(); ?></p>
                <p><a href="/">Home page</a></p>
            </div>
        </div>
    </body>
</html>
