@extends('dashboard.layouts.master')
@section('title', '  انشاء أدمن')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">  انشاء أدمن </li>
@endsection
@section('css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
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
                                    <input type="name" class="form-control" id="name" placeholder="أدخل الاسم">
                                </div>

                                <div class="form-group">
                                    <label for="email">الايميل</label>
                                    <input type="email" class="form-control" id="email" placeholder="أدخل الايميل ">
                                </div>
                                <div class="form-group">
                                    <label>اختر الدور</label>
                                    <select class="form-control roles" id="role_id">
                                        @foreach ($roles as $role )
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>

                              <div class="form-group">
                                <label>حالة الأدمن</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active">
                                    <label class="custom-control-label" for="active">مفعل</label>
                                </div>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="store()" class="btn btn-primary">انشاء</button>
                                </div>
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
<script src="{{asset('admin-asset/plugins/select2/js/select2.full.min.js')}}"></script>
      <script>
             $('.guards').select2({
      theme: 'bootstrap4'
    })


function store(){
        axios.post('/admin/admin/',{
            role_id : document.getElementById('role_id').value,
            name : document.getElementById('name').value,
            email : document.getElementById('email').value,
            active: document.getElementById('active').checked,
         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/admin/";
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
