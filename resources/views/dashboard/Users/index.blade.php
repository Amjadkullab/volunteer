@extends('dashboard.layouts.master')
@section('title', 'المستخدمين')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">  المستخدمين</li>
@endsection
@section('page-title','user page')
@section('main-page-title','Home')
@section('small-page-title','users')
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div class="row">
        <div class="col-12">
          <div class="card">
        
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover table-bordered table-striped text-nowrap">
                <thead>
                  <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>الايميل</th>
                    <th>الحالة</th>
                    <th> وقت الانشاء</th>
                    <th>وقت التعديل </th>
                    <th>الاعدادات</th>
                  </tr>
                </thead>
                <tbody>
@foreach ($users as $user)
<tr>
  {{-- {{ dd($admin)}} --}}
    <td>{{$user->id}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td><span class="badge @if($user->active) bg-success  @else bg-danger @endif ">{{$user->status}}</span></td>

    {{-- <td>@if ($admin->active) Active @else Disables @endif </td> --}}
    <td>{{$user->created_at}}</td>
    <td>{{$user->updated_at}}</td>
    <td>
        <div class="btn-group">
          <a href="{{route('dashboard.user.edit',$user->id)}}" class="btn btn-info">
            <i class="fas fa-edit"></i>
          </a>


          {{-- استخدام جافاسكريبت لعملية الحذف --}}


<a href="#" class="btn btn-danger" onclick="confirmdestroy({{$user->id}},this)" >
    <i class="fas fa-trash"></i>
</a>


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
    axios.delete('/admin/user/' + id)
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

