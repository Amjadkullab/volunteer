@extends('dashboard.layouts.master')
@section('title', 'تعديل مستخدم ')
@section('page-title', 'Update User')
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
                        <div class="card-header">
                            {{-- <h3 class="card-title">تعديل المستخدم </h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="updated_form"  >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="name" class="form-control" id="name" placeholder="ادخل الاسم "
                                    value="{{$user->name}}">
                                </div>
                                {{-- <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->

                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="image">
                                      <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                  </div> --}}
                                  <div class="form-group">
                                    <label for="email">الايميل</label>
                                    <input type="email" class="form-control" id="email" placeholder="ادخل الايميل "
                                    value="{{$user->email}}">
                                </div>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"@if($user->id==auth('admin')->id) disabled @endif id="active"
                                    @if ($user->active)
                                    checked
                                    @endif>
                                    <label class="custom-control-label" for="active">مغعل</label>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="update({{$user->id}})" class="btn btn-primary">تعديل</button>
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


    function update(id){
        axios.put('/admin/admin/'+ id,{
            name : document.getElementById('name').value,
            email : document.getElementById('email').value,
            active: document.getElementById('active').checked,

         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    document.getElementById('updated_form').reset();
  })
  .catch(function (error) {
    // handle error
    console.log(error);
    toastr.error(error.response.data.message);
  })
  .then(function () {
    // always executed
  });


//     function update(id){
//         let formData = new FormData;
//         formData.append('name' , document.getElementById('name').value);
//         formData.append('active' , document.getElementById('active').checked ? 1: 0);
//         formData.append('image' , document.getElementById('image').files[0]);
//         axios.put('/admin/categories/'+ id,formData )
//   .then(function (response) {
//     // handle success
//     console.log(response);
//     toastr.success(response.data.message);
//     window.location.href="/admin/categories";
//   })
//   .catch(function (error) {
//     // handle error
//     console.log(error);
//     toastr.error(error.response.data.message);
//   })
//   .then(function () {
//     // always executed
//   });




    // }

    }


</script>

@endsection
