@extends('dashboard.layouts.master')
@section('title', 'انشاء مؤسسة')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> المؤسسات والجمعيات</li>
    <li class="breadcrumb-item active">انشاء مؤسسة </li>
@endsection

@section('content')
    <div class="content">
        <form action="{{ route('dashboard.institution.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('dashboard.institution._form',[
            'button_label' => 'اضافة'
            ])
        </form>
    </div>
@endsection
