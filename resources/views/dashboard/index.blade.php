@extends('dashboard.layouts.master')

@section('title','الصفحة الرئيسية')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">الصفحة الرئيسية</li>
@endsection

@section('content')
<div class="content">
    {{-- <p>نظام ادارة العمل التطوعي</p> --}}
   
    <div class="btn btn-primary" style="width: 100%"><span>نظام ادارة العمل التطوعي</span></div>

    <div class="row" style="background-image : url({{ asset('admin-asset/images/RM.jpg')}});background-size:cover;background-repeat:ni-repeat; min-height:1000px;"></div>

</div>
@endsection

