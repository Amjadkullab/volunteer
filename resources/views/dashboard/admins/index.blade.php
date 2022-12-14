@extends('dashboard.layouts.master')
@section('title', 'عرض الأدمن')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">  عرض الادمن</li>
@endsection
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div class="row">
        <div class="col-12">
          <div class="card">

              {{-- <h3 class="card-title">الأدمن</h3> --}}

              {{-- <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div> --}}
    
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="example2" class="table table-bordered table-hover" >
                    <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
                  <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>الايميل</th>
                    <th>الدور</th>
                    <th>الحالة</th>
                    <th> وقت الانشاء</th>
                    <th> وقت التعديل</th>
                    <th>الاعدادات</th>
                  </tr>
                </thead>
                <tbody>
@foreach ($admins as $admin)
<tr>
  {{-- {{ dd($admin)}} --}}
    <td>{{$admin->id}}</td>
    <td>{{$admin->name}}</td>
    <td>{{$admin->email}}</td>
    <td>
        @foreach ($admin->roles as $role)
        <span class="badge bg-primary ">{{ $role->name }}</span>
    @endforeach
    </td>
    <td><span class="badge @if($admin->active) bg-success  @else bg-danger @endif ">{{$admin->status}}</span></td>

    {{-- <td>@if ($admin->active) Active @else Disables @endif </td> --}}
    <td>{{$admin->created_at}}</td>
    <td>{{$admin->updated_at}}</td>
    <td>

        <div class="btn-group">
            @can(['Update-Admin'])
          <a href="{{route('dashboard.admin.edit',$admin->id)}}" class="btn btn-info">
            <i class="fas fa-edit"></i>
          </a>
          @endcan

          @if (auth('admin')->user()->id != $admin->id)
<a href="#" class="btn btn-danger" onclick="confirmdestroy({{$admin->id}},this)" >
    <i class="fas fa-trash"></i>
</a>
@endif




{{--
          <form method="POST" action="{{route('admins.destroy',$admin->id)}}">
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
    axios.delete('/admin/admin/' + id)
  .then(function (response) {
    // handle success
     console.log(response);
     reference.closest('tr').remove();
     showmessage(response.data);
  })
  .catch(function (error) {
    // handle error
     console.log(error);

//ط¹ظ†ط¯ظٹ ظ…ط´ظƒظ„ط© ظپظٹظ‡ ط¹ظ…ظ„ظٹط© ط§ظ„ط­ط°ظپ
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

