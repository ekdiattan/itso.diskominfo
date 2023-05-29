<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Diskominfo Jabar | Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/jabar.png') }}">
  </head>
  <body>
    <video autoplay muted loop id="myVideo" >
      <source src="/assets/videos/diskominfo.mp4" type="video/mp4">
    </video>
    <a href="https://diskominfo.jabarprov.go.id">
      <img src="https://diskominfo.jabarprov.go.id/dev2021/img/logo_diskom.svg"class="mx-auto d-block" alt="Image"height="100" width="260">
    </a>
    <div class="container-scroller">
      <!-- <div class="container-fluid page-body-wrapper full-page-wrapper"> -->
        <!-- <div class="row w-100 m-0"> -->
          <!-- <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg"> -->
            <div class="card col-lg-4 mx-auto" id="logins">
              <div class="card-body px-5 py-5">
                @foreach ($errors->all() as $message)
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @endforeach
                <marquee>Selamat Datang di Website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat, Alamat : Jl. Tamansari No.55, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132, Telp : 0222502898, Website : diskominfo.jabarprov.go.id</marquee>
                <h3 class="card-title text-left mb-3">Login</h3>
                <main class="form-signin" id="main">  
                  <form action="\login" method="post">  
                      @csrf   
                    <div class="form-group">
                      <label>Username *</label>
                      <input type="text" class="form-control p_input" id="username" name="username" autofocus required>
                    </div>
                    <div class="form-group">
                      <label>Password *</label>
                      <input type="password" class="form-control p_input" id="password" name="password" required>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input"> Remember me </label>
                      </div>
                      <!-- <a href="#" class="forgot-pass">Forgot password</a> -->
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block enter-btn" id="submit-btn">Login</button>
                      <p class="text-center mt-3">© Dinas Komunikasi & Informatika Provinsi Jawa Barat 2023</p>
                    </div>
                  </form>
                </main>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
  <script>
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const submitBtn = document.getElementById('submit-btn');

    username.addEventListener('input', validateForm);
    password.addEventListener('input', validateForm);

    document.getElementById("submit-btn").disabled = true;

    function validateForm() {
      if (username.value.trim() === '' || password.value.trim() === '') {
        submitBtn.disabled = true;
      } else {
        submitBtn.removeAttribute('disabled');
      }
    }
  </script>
</html>