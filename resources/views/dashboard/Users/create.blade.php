@extends('dashboard.layouts.master')
@section('title', 'انشاء مستخدم')
@section('page-title', 'Create User')
@section('main-page-title', 'Home')
@section('small-page-title', 'Users')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                       
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="name" class="form-control" id="name" placeholder="ادخل الاسم">
                                </div>

                                <div class="form-group">
                                    <label for="email">الايميل</label>
                                    <input type="email" class="form-control" id="email" placeholder="ادخل الايميل ">
                                </div>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active">
                                    <label class="custom-control-label" for="active">تم الانضمام</label>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="store()" class="btn btn-primary">انشاء</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->



                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    </div>
@endsection
@section('scripts')
<script>
function store(){
        axios.post('/admin/user/',{
            name : document.getElementById('name').value,
            email : document.getElementById('email').value,
            active: document.getElementById('active').checked,
         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/user/";
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




//     function store(){
//         let formData = new FormData;
//         formData.append('name' , document.getElementById('name').value);
//         formData.append('email', document.getElementById('email').value);
//         formData.append('active', document.getElementById('active').checked);
// axios.post('admin/admins/',formData )
//   .then(function (response) {
//     // handle success
//     console.log(response);
//     toastr.success(response.data.message);
//     window.location.href="/admin/admins/";
//   })
//   .catch(function (error) {
//     // handle error
//     console.log(error);
//     toastr.error(error.response.data.message);
//   })
//   .then(function () {
//     // always executed
//   });




//     }


</script>

@endsection
