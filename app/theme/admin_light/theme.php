<?php /** @var \App\Framework\Visual\ThemeInterface $this */  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title><?= $this->getTitle(); ?></title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        
        <?php $this->includeCSSCodeFromFile(__DIR__ . '/assets/main.css'); ?>
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
                        <a href="/admin/users/page/1">Users</a>
                        <a href="/admin/#">Go to public</a>
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
                                <a href="/admin/pages/page/1">Pages</a>
                                <ul>
                                    <li><a href="/admin/pages/add/">Add</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/admin/estates/page/1">Estates</a>
                                <ul>
                                    <li><a href="/admin/estates/add/">Add</a></li>
                                    <li>
                                        <a href="/admin/estates/categories/page/1">Categories</a>
                                        <ul>
                                            <li><a href="/admin/estates/category/add/">Add</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7">
                        <?= $this->getContent(); ?>
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
