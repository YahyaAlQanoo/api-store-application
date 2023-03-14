<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Forgot Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            <form >
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" id="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="button" onclick="updatePassword()" class="btn btn-primary btn-block">Change password</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
      
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function updatePassword()
    {
        axios.post('/reset-password',{
            token: '{{ $token }}',
            email: '{{ $email }}',
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,

        })
        .then(function(response) {
            toastr.success(response.data.message)
        })
        .catch(function(error) {
            toastr.error(error.response.data.message);

        });

    }


    // axios.delete(`/cms/admin/categories/${id}`)
    //       .then(function(response) {
    //           // console.log(response);
    //           document.getElementById(`category_${id}`).remove();
    //           showMessage(response.data.icon, response.data.message)
    //       })
    //       .catch(function(error) {
    //           console.log(error);
    //           showMessage(error.response.data.icon, error.response.data.message)
    //       });

</script>
</body>

</html>
