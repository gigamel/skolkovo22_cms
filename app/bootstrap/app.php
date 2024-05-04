<?php

use App\Common\Factory;

$container = Factory::createContaier();
$container->set('config.env', 'dev');

$eventsListener = Factory::createEventListener();
$eventsListener->trigger('http.get.response');

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if ('' === $uri) {
    $uri = 'index';
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
        body {
          background-color: #181818;
          color: #d1d1d1;
          font-size: 16px;
          font-family: sans-serif;
        }
        
        a {
            color: #d1d1d1;
            text-decoration: none;
        }
        a:hover {
            color: #a8cc7c;
        }
        
        header {
            background-color: #292929;
        }
        
        .logo {
            color: #62d9fb;
        }
        .logo:hover {
            color: #aa9cd3;
        }
        
        header,
        main,
        footer {
            padding-top: 25px;
            padding-bottom: 25px;
        }
        
        main a {
            font-size: 75%;
        }
        
        .documentation {
            border: 1px solid #292929;
            font-size: 75%;
            padding: 15px;
        }
        
        .breadcrumbs {
            font-size: 75%;
            margin-bottom: 15px;
        }
        .breadcrumbs a {
            font-size: 100%;
        }
        
        .pagination {
            letter-spacing: 10px;
        }
        .pagination a {
            color: #62d9fb;
            font-size: 100%;
        }
        </style>
    </head>
    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <a href="/" class="logo">Skolkovo22CMS</a>
                    </div>
                    <div class="col-md-9">
                        <a href="/settings/">Settings</a>
                        <a href="/users/">Users</a>
                        <a href="/#">Go to public</a>
                    </div>
                  <div class="col-md-1">
                      <div class="logout">
                          <a href="/logout/">Logout</a>
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
                                <a href="/pages/">Pages</a>
                                <ul>
                                    <li><a href="/pages/add/">Add</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/estates/">Estates</a>
                                <ul>
                                    <li><a href="/estates/add/">Add</a></li>
                                    <li><a href="/estates/types/">Types</a></li>
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
