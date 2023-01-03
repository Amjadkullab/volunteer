@extends('dashboard.layouts.master')
@section('title', 'الاعمال التطوعية')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">الاعمال التطوعية</li>
@endsection

@section('content')
<table id="example2" class="table table-bordered table-hover" >
    <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
           
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الصورة</th>
                    <th>فئة العمل التطوعي</th>
                    <th>الموقع</th>
                    <th>الحالة</th>
                    <th>تاريخ الانشاء</th>
                    <th>تاريخ التعديل</th>
                    <th colspan="2">الاعدادات</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td> <a href="{{route('dashboard.posts.show',$post->id)}}"> {{ $post->title }}</a></td>
                        <td><img src="{{ asset('uploads/posts/' . $post->image) }}" width="120" height="80"> </td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->location }}</td>
                        <td>{{ $post->status == 'active' ? 'نشط' : 'أرشيف' }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            @can(['Update-Post'])
                            <a href="{{ route('dashboard.posts.edit', $post->id) }}"
                                class="btn btn-sm btn-outline-info">تعديل</a>
                                @endcan
                        </td>
                        <td>

                            <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                @can(['Delete-Post'])
                                <button class="btn btn-sm btn-outline-danger">حذف</button>
                                @endcan
                            </form>

                        </td>
                    </tr>
                </tbody>
                @empty
                    <td colspan="9">لا يوجد اعمال تطوعية ..</td>
                @endforelse
        </table>
@endsection
