@extends('dashboard.layouts.master')
@section('title', 'تعديل المؤسسة')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> المؤسسات والجمعيات</li>
    <li class="breadcrumb-item active">تعديل المؤسسة</li>
@endsection

@section('content')
    <div class="content">
        <form action="{{ route('dashboard.institution.update' ,$institution->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('dashboard.institution._form',[
            'button_label' => 'تعديل'
            ])
        </form>
    </div>
@endsection
