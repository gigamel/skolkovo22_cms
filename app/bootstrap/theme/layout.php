<?php

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if ('/admin' === $uri) {
    $uri = '/admin/index';
}
$layout = getcwd() . '/bootstrap/layout/' . $uri . '.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Some title</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <style>
        <?php require_once __DIR__ . '/main.css'; ?>
        </style>
    </head>
    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <a href="/admin/" class="logo">Skolkovo22CMS</a>
                    </div>
                    <div class="col-md-9">
                        <a href="/admin/settings/">Settings</a>
                        <a href="/admin/users/">Users</a>
                        <a href="/">Go to public</a>
                    </div>
                  <div class="col-md-1">
                      <div class="logout">
                          <a href="/admin/logout/">Logout</a>
                      </div>
                  </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <ul>
                            <li>
                                <a href="/admin/pages/">Pages</a>
                                <ul>
                                    <li><a href="/admin/pages/add/">Add</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/admin/estates/">Estates</a>
                                <ul>
                                    <li><a href="/admin/estates/add/">Add</a></li>
                                    <li><a href="/admin/estates/types/">Types</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7">
                        <?php if (file_exists($layout)): ?>
                            <?php require_once $layout; ?>
                        <?php else: ?>
                            <h1>Page Not Found</h1>
                            <p>Unknown resource</p>
                        <?php endif; ?>
                    </div>
                  <div class="col-md-3">
                      <div class="documentation">
                      How to add item settings?
                      </div>
                  </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <p>
                            &copy; Developed by <a href="https://github.com/gigamel" target="_blank">Aleksey Sh.</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
