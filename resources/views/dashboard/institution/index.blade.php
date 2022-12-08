@extends('dashboard.layouts.master')
@section('title', 'المؤسسات  والجمعيات ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> المؤسسات  والجمعيات</li>
@endsection

@section('content')
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>صورة الغلاف</th>
                    <th>صورة اللوجو</th>
                    <th>الوصف</th>
                    <th>الايميل</th>
                    <th>الدور</th>
                    <th>الصلاحيات</th>
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
                        <td><img src="{{ asset('storage/' . $institution->cover_image) }}" width="120" height="80"> </td>
                        <td><img src="{{ asset('storage/' . $institution->logo_image) }}" width="120" height="80"> </td>
                        <td>{{ $institution->description }}</td>
                        <td>{{ $institution->email }}</td>
                        {{-- <td>
                            @foreach ($institution->roles as $role)
                                <span class="badge bg-primary ">{{ $role->name }}</span>
                            @endforeach
                        </td> --}}
                        <td>
                              <a href="{{route('dashboard.institutions.permissions.index',$institution->id)}}" class="btn btn-info">({{$institution->permissions_count}}) الصلاحيات
                        </td>

                        <td> @if ($institution->active == 1)مفعلة  @else معطل @endif</td>
                        <td>{{ $institution->created_at }}</td>
                        <td>{{ $institution->updated_at }}</td>
                        <td>
                            @can(['Update-Institution'])
                            <a href="{{ route('dashboard.institution.edit', $institution->id) }}"
                                class="btn btn-sm btn-outline-info">تعديل</a>
                                @endcan
                        </td>
                        <td>
                            @can(['Delete-Institution'])
                            <form action="{{ route('dashboard.institution.destroy', $institution->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger">حذف</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                </tbody>
                @empty
                    <td colspan="9">لا يوجد مؤسسات</td>
                @endforelse
        </table>
@endsection
