@extends('dashboard.layouts.master')
@section('title', '  تعديل أدمن')

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
                        <div class="card-header">
                            {{-- <h3 class="card-title">تعديل أدمن </h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="updated_form">
                            @csrf
                            {{-- @if (auth('admin')->id() != $admin->id) --}}
                            <div class="form-group">
                                <label>اسم الدور </label>
                                <select class="form-control roles " id="role_id" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                              {{-- @endif --}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="name" class="form-control" id="name" placeholder="Enter name"
                                    value="{{$admin->name}}">
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
                                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    value="{{$admin->email}}">
                                </div>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"id="active"
                                    @if ($admin->active)
                                    checked
                                    @endif>
                                    <label class="custom-control-label" for="active">مفعل</label>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="update({{$admin->id}})" class="btn btn-primary">تعديل</button>
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
    function update(id){
        axios.put('/admin/admin/'+ id,{
            role_id: document.getElementById('role_id').value,
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


    }


</script>

@endsection
