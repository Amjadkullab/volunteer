<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تسجيل الدخول </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-asset/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

        <div  style="width: 100%;text-align:center; font-size:20px"><h5> تسجيل الدخول لنظام ادارة العمل التطوعي</h5></div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <img src="{{asset('admin-asset/images/R.jpeg')}}" alt="" style="height: 80px;text-align: center; display: block; margin-left: auto;margin-right: auto; backgruond-color:rgba(153, 147, 147, 0.938);">
      <p class="login-box-msg" style="color: rgb(124, 111, 238)">تسجيل الدخول</p>

      <form>
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="أدخل الايميل">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="أدخل كلمة المرور">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
               ذكرني
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" onclick="login('{{$guard}}')" class="btn btn-primary btn-block"> دخول </button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="forgot-password.html">نسيت كلمة المرور</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin-asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-asset/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('admin-asset/plugins/toastr/toastr.min.js')}}"></script>

<script>
    function login(guard){
        axios.post('/loginpost',{
            'email' : document.getElementById('email').value,
            'password' : document.getElementById('password').value,
            'remember' : document.getElementById('remember').checked,
            'guard':guard

         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/";
  })
  .catch(function (error) {
    // handle error
    console.log(error);
    toastr.error(error.response.data.message);
  })
  .then(function () {
    // always executed
  });




    }

    </script>



 {{-- <script>
    function login(){
        axios.post('/admin/login/',{
            email : document.getElementById('email').value,
            password : document.getElementById('password').value,
            remember : document.getElementById('remember').checked

         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/";
  })
  .catch(function (error) {
    // handle error
    console.log(error);
    toastr.error(error.response.data.message);
  })
  .then(function () {
    // always executed
  });




    }

    </script> --}}





</body>
</html>
