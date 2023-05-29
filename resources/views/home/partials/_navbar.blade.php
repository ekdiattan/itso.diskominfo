<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav class="sticky-top main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <marquee bgcolor="#FFFFFF"><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang {{ auth()->user()->nama }} di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
 
  <ul class="navbar-nav ml-auto">
    <div class="container">
      <a href="#" class="navbar-brand" id="profileDropdown" data-toggle="dropdown">
      <img src="{{ $user->profile_picture ?? asset('assets/images/faces/face15.jpg') }}" alt="Avatar" class="brand-image img-circle" style="height: 50px;width:50px;">
        <span class="brand-text font-weight-light">{{ auth()->user()->nama }}</span>
        <i class="fas fa-caret-down"></i>
      </a>
      
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
        <h6 class="p-3 mb-0">Profile</h6>
        <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="/account/{{ auth()->user()->id }}">
            <div class="preview-thumbnail">
              <i class="fas fa-cog">Settings</i>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="/logout">
            <div class="preview-thumbnail">
              <i class="nav-icon fas fa-sign-out-alt">Log Out</i>
            </div>
          </a>
        <div class="dropdown-divider"></div>
        <p class="p-3 mb-0 text-center">Advanced settings</p>
      </div>
    </div>
  </ul>
  </nav>
</body>
</html>
