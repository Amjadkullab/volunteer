@extends('dashboard.layouts.master')
@section('title', ' تعديل الدور')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> تعديل الدور</li>
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
                        <form id="updated_form"  >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="name" class="form-control" id="name" placeholder="أدخل الاسم "
                                    value="{{$role->name}}">
                                </div>



                                <div class="form-group">
                                    <label for="guard_name">بوابة</label>
                                    <input type="name" class="form-control" id="guard_name" placeholder="أدخل اسم البوابة "
                                    value="{{$role->guard_name}}">
                                </div>
                                {{-- <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->

                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="image">
                                      <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                  </div> --}}

{{--
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active"
                                    @if ($category->active)
                                    checked
                                    @endif>
                                    <label class="custom-control-label" for="active">Active</label>
                                </div> --}}

                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="update({{$role->id}})" class="btn btn-primary">تعديل الدور </button>
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
    function update(id){
        axios.put('/admin/roles/'+ id,{
            name : document.getElementById('name').value,
            guard_name: document.getElementById('guard_name').value,

         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/roles";
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

@endsection
