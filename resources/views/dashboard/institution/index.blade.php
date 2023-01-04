@extends('dashboard.layouts.master')
@section('title', 'المؤسسات  والجمعيات ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> المؤسسات  والجمعيات</li>
@endsection

@section('content')
<table id="example2" class="table table-bordered table-hover" >
    <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>صورة الغلاف</th>
                    <th>صورة اللوجو</th>
                    {{-- <th>الوصف</th> --}}
                    <th>الايميل</th>
                    <th>الدور</th>
                    {{-- <th>الصلاحيات</th> --}}
                    <th>الحالة</th>
                    <th>تاريخ الانشاء</th>
                    <th>تاريخ التعديل</th>
                    <th colspan="2">الاعدادات</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($institutions as $institution)
                    <tr>
                        <td>{{ $institution->id }}</td>
                        <td>{{ $institution->name }}</td>
                        <td><img src="{{ asset('uploads/cover_image/'. $institution->cover_image) }}" width="120" height="80"> </td>
                        <td><img src="{{ asset('uploads/logo_image/' . $institution->logo_image) }}" width="120" height="80"> </td>
                        {{-- @can(['Show-Institutions'])
                        <td><a href="{{route('dashboard.institution.show',$institution->id)}}">{{ $institution->description }}</a></td>
                        @endcan --}}
                        <td>{{ $institution->email }}</td>
                        <td>
                            @foreach ($institution->roles as $role)
                            <span class="badge bg-primary ">{{ $role->name }}</span>
                        @endforeach
                        </td>
                        {{-- <td>
                              <a href="{{route('dashboard.institutions.permissions.index',$institution->id)}}" class="btn btn-info">({{$institution->permissions_count}}) الصلاحيات
                        </td> --}}
                        <td><span class="badge @if($institution->active) bg-success  @else bg-danger @endif ">{{$institution->status}}</span></td>
                        <td>{{ $institution->created_at }}</td>
                        <td>{{ $institution->updated_at }}</td>
                        <td>
                            <div class="btn-group">
                            @can(['Update-Institution'])
                            <a href="{{ route('dashboard.institution.edit', $institution->id) }}"
                              class="btn btn-info"> <i class="fas fa-edit"></i></a>
                                @endcan

                                <a href="#" class="btn btn-danger" onclick="confirmdestroy({{$institution->id}},this)" >
                                    <i class="fas fa-trash"></i>
                                </a>
                            {{-- @can(['Delete-Institution'])
                            <form action="{{ route('dashboard.institution.destroy', $institution->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger">حذف</button>
                            </form>
                            @endcan --}}
</div>
                        </td>
                    </tr>
                </tbody>
                @empty
                    <td colspan="9">لا يوجد مؤسسات</td>
                @endforelse
        </table>
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
    axios.delete('/admin/institution/' + id)
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
