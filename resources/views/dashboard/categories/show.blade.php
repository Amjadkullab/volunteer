@extends('dashboard.layouts.master')
@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{$category->name}}</li>
@endsection

@section('content')

<table id="example2" class="table table-bordered table-hover" >
    <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
            <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>الصورة</th>
                <th>الوصف</th>
                <th>حالة الفئة</th>
                <th>تاريخ الانشاء</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($category->posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td><img src="{{ asset('uploads/categories/' . $post->image) }}" width="120" height="80"> </td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->status == 'active' ? 'نشط' : 'أرشيف' }}</td>
                    <td>{{ $post->created_at }}</td>
                </tr>
        </tbody>
    @empty
        <td colspan="7">لا يوجد أقسام ..</td>
        @endforelse
    </table>

@endsection
