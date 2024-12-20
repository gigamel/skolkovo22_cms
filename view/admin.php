<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8"/>
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <header class="header pt-3 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="logo">
              <a href="/admin/">
                Administrator
              </a>
            </div>
          </div>
          <div class="col-md-9">
            <nav>
              <ul>
                <li>
                  <a href="/">To site</a>
                </li>
                <li>
                  <a href="/admin/complexes/">Complexes</a>
                </li>
                <li>
                  <a href="/admin/logout/">Logout</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <main>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?= $content ?? ''; ?>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
