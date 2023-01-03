@extends('dashboard.layouts.master')
@section('title', $post->title)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">الاعمال التطوعية</li>
    <li class="breadcrumb-item active">{{$post->title}}</li>

@endsection

@section('content')
<table id="example2" class="table table-bordered table-hover" >
    <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
                <tr>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>الصورة</th>
                    <th>الموقع</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>


                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td><img src="{{ asset('uploads/posts/' . $post->image) }}" width="120" height="80"> </td>
                        <td>{{ $post->location }}</td>
                        <td>{{ $post->status == 'active' ? 'نشط' : 'أرشيف' }}</td>
                    </tr>
                </tbody>

        </table>
@endsection
