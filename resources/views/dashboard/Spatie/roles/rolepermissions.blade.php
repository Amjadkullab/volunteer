@extends('dashboard.layouts.master')
@section('title', ' الصلاحيات')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> الصلاحيات</li>
@endsection
@section('styles')
<link rel="stylesheet" href="{{asset('admin-asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

@endsection
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> الصلاحيات{{$role->name}}</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover table-bordered table-striped text-nowrap">
                <thead>
                  <tr>
                    <th>الاسم</th>
                    <th>البوابة</th>
                    <th>الحالة</th>

                  </tr>
                </thead>
                <tbody>
@foreach ($permissions as $permission)
<tr>
  {{-- {{ dd($permission)}} --}}

    <td>{{$permission->name}}</td>
    <td><span class="badge bg-success">{{$permission->guard_name}}</span></td>
    <td> <div class="icheck-primary d-inline">
        <input onchange="assignPermission({{$role->id}},{{$permission->id}})" type="checkbox"  id="permission_{{$permission->id}}" @if($permission->assigned) checked @endif >
        <label for="permission_{{$permission->id}}">
        </label>
      </div>   </td>
    {{-- <td>@if ($permission->active) Active @else Disables @endif </td> --}}




          {{-- استخدام جافاسكريبت لعملية الحذف --}}




{{--
          <form method="POST" action="{{route('r.destroy',$permission->id)}}">
          @csrf
          @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
              </button>
          </form> --}}


        </div>
      </td>

  </tr>
@endforeach


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('scripts')
<script>
function assignPermission(roleId,permissionId){
        axios.post('/admin/roles/'+roleId+'/permissions/',{
            permission_id : permissionId
        })

  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);

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

{{-- axios.post('/admin/categories/',{
    //             name : document.getElementById('name').value,
    //             active: document.getElementById('active').checked
    //          })
    //   .then(function (response) {
    //     // handle success
    //     console.log(response);
    //     toastr.success(response.data.message);
    //     window.location.href="/admin/categories/";
    //   })
    //   .catch(function (error) {
    //     // handle error
    //     console.log(error);
    //     toastr.error(error.response.data.message);
    //   })
    //   .then(function () {
    //     // always executed
    //   }); --}}
