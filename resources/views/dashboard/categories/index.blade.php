@extends('dashboard.layouts.master')
@section('title', 'فئات العمل التطوعي')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">فئات العمل التطوعي</li>
@endsection

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
    @endif

    <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
        <input type="text" name="name" class="form-control mx-2" placeholder="اسم الفئة" value="{{ request('name') }}">
        <select name="status" class="form-control mx-2">
            <option value="">الكل</option>
            <option value="active" @selected(request('status') == 'active')>نشط</option>
            <option value="archived" @selected(request('status') == 'archived')>ارشيف</option>
        </select>
        <button class="btn btn-dark  mx-2">بحث</button>
    </form>

     <table id="example2" class="table table-bordered table-hover" >
        <thead class="custom_thead" style="background-color:rgb(160, 152, 152) ">
            <tr>
                <th>#</th>
                <th>اسم الفئة</th>
                <th>صورة الفئة</th>
                <th>عدد الاعمال التطوعية </th>
                <th>حالة الفئة</th>
                <th>تاريخ الانشاء</th>
                <th>تاريخ التعديل</th>
                <th colspan="2">الاعدادات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td> <a href="{{route('dashboard.categories.show',$category->id)}}"> {{ $category->name }}</a></td>
                    <td><img src="{{ asset('uploads/categories/' . $category->image) }}" width="120" height="80"> </td>
                    <td>{{$category->posts_count}}</td>
                    <td>{{ $category->status == 'active' ? 'نشط' : 'أرشيف' }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        @can(['Update-VolunteerCategory'])
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-primary">تعديل</a>
                            @endcan
                    </td>
                    <td>
                        @can(['Delete-VolunteerCategory'])
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>
                        @endcan
                    </td>
                </tr>
        </tbody>
    @empty
        <td colspan="7">لا يوجد أقسام ..</td>
        @endforelse
    </table>

    {{ $categories->withQueryString()->appends(['search' => 1])->links() }}
@endsection
