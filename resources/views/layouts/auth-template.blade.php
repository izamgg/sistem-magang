<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Magang Sidang</title>
  <link rel="stylesheet" href="/template/assets/css/main/app.css">
  <link rel="stylesheet" href="/template/assets/css/pages/auth.css">
  <link rel="shortcut icon" href="/template/assets/images/logo/favicon.svg" type="image/x-icon">
  <link rel="shortcut icon" href="/template/assets/images/logo/favicon.png" type="image/png">

  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-5 col-12">
        {{-- Content Auth Start --}}
        @yield('content-auth')
        {{-- Content Auth End --}}
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>

  </div>
</body>

</html>
