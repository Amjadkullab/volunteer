@extends('dashboard.layouts.master')
@section('title', 'المؤسسات')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> المؤسسات والجمعيات</li>
    {{-- <li class="breadcrumb-item active">{{$post->title}}</li> --}}

@endsection

@section('content')
<table id="example2" class="table table-bordered table-hover" >
    <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
                <tr>
                    <th>اسم المؤسسة</th>
                    <th>صورة الغلاف</th>
                    <th>صورة اللوجو</th>
                    <th>الوصف</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>


                    <tr>
                        <td>{{ $institution->name }}</td>
                        <td><img src="{{ asset('storage/' . $institution->cover_image) }}" width="120" height="80"> </td>
                        <td><img src="{{ asset('storage/' . $institution->logo_image) }}" width="120" height="80"> </td>
                        <td>{{ $institution->description }}</td>
                        <td> @if ($institution->active == 1)مفعلة  @else معطل @endif</td>
                    </tr>
                </tbody>

        </table>
@endsection
