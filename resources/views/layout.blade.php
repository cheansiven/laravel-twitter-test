<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
    <div class="container">
      <div class="header clearfix">
          <nav>
              <ul class="nav nav-pills float-right">
                  <li class="nav-item">
                      <a class="nav-link active" href="/">Home</a>
                  </li>
              </ul>
          </nav>
          <h3>Twitter Test App</h3>
      </div>
        <div class="row">
            <div class="col-lg-8 center">
                @yield('content')
            </div>
        </div>
    </div> <!-- /container -->
</body>
</html>
