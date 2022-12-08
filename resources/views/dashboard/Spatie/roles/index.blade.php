@extends('dashboard.layouts.master')
@section('title', 'الأدوار')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> الأدوار</li>
@endsection
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">الأدوار</h3>

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
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>البوابة</th>
                    <th>الصلاحيات</th>
                    <th> وقت الانشاء</th>
                    <th> وقت التعديل</th>
                    <th>الاعدادات</th>
                  </tr>
                </thead>
                <tbody>
@foreach ($roles as $role)
<tr>
  {{-- {{ dd($role)}} --}}
    <td>{{$role->id}}</td>
    <td>{{$role->name}}</td>
    <td><span class="badge bg-success">{{$role->guard_name}}</span></td>
    <td>  <a href="{{route('dashboard.roles.permissions.index',$role->id)}}" class="btn btn-info">({{$role->permissions_count}}) الصلاحيات </td>
    {{-- <td>@if ($role->active) Active @else Disables @endif </td> --}}
    <td>{{$role->created_at}}</td>
    <td>{{$role->updated_at}}</td>
    <td>

        <div class="btn-group">
            @can(['Update-Role'])
          <a href="{{route('dashboard.roles.edit',$role->id)}}" class="btn btn-info">
            <i class="fas fa-edit"></i>
          </a>
          @endcan


          {{-- استخدام جافاسكريبت لعملية الحذف --}}

          @can(['Delete-Role'])
<a href="#" class="btn btn-danger" onclick="confirmdestroy({{$role->id}},this)" >
    <i class="fas fa-trash"></i>
</a>
@endcan

{{--
          <form method="POST" action="{{route('r.destroy',$role->id)}}">
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
    function confirmdestroy(id,reference){

  Swal.fire({
  title: 'هل انت متأكد؟',
  text: "لن تتمكن من التراجع عن هذا!",
  icon: 'تحذير',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'نعم , تم الحذف !'
}).then((result) => {
  if (result.isConfirmed) {
    destroy(id,reference);
  }
})
 }


function destroy(id,reference){
    axios.delete('/admin/roles/' + id)
  .then(function (response) {
    // handle success
     console.log(response);
     reference.closest('tr').remove();
     showmessage(response.data);
  })
  .catch(function (error) {
    // handle error
     console.log(error);

//عندي مشكلة فيه عملية الحذف
     showmessage(error.response.data);
  })


}
function showmessage(data){
Swal.fire({
icon:data.icon,
title:data.title,
text:data.text,
showConfirmButton:false,
  timer: 1500
})
}



</script>


@endsection

