<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Page Title</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
    pre {
      background-color: #180b1a;
      color: #77708d;
      font-size: 12px;
      overflow-x: auto;
      border-radius: 5px;
      padding: 15px;
    }
    </style>
  </head>
  <body>
    <div class="app">
      <div class="header">
        <div class="container">
          <div class="row">
            <div class="col-6">
              <nav class="navbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="/contacts/">Contacts</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="col-6">
              <div class="small-cart pt-5">
                <?= \widget('\\App\\Widget\\Magazine\\MiniCart')->render('default.php'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <hr/>  
