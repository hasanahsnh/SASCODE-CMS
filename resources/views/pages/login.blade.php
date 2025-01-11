<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Content Management</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('pengunjung/images/sascode-logo.jpg') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body style="color: white; font-family: Arial, sans-serif;">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center" style="background-color: #030405">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo" style="align-items: center;">
                <h3 style="margin-left:13px; margin-bottom:50px; display: flex;">Manajemen Publikasi</h3>
              </div>
              <form action="{{ route('masuk') }}" method="POST">
                @csrf
                <div class="form-group">
                    <i class="mdi mdi-account-check" style="margin-right:6px; margin-left:6px"></i>
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" style="border-radius: 18px; color:white" required>
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <i class="mdi mdi-lock" style="margin-right:6px; margin-left:6px"></i>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" style="border-radius: 18px; color:white" required>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="margin-top:30px; background: #8C3061; border:none; outline:none; box-shadow: none; border-radius: 18px;">Masuk</button>
                <p style="font-size: 12px; margin-top:20px; margin-left:13px">Terdapat kendala saat mencoba masuk? <a href="https://wa.me/6289696210706" style="color: #8C3061; text-decoration:none">Hubungi Kami</a></p>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <!-- endinject -->
</body>

</html>
