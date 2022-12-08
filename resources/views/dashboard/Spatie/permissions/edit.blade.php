@extends('dashboard.layouts.master')
@section('title', 'تعديل صلاحية ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">  تعديل صلاحية</li>
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin-asset/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">تعديل الصلاحية </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Minimal</label>
                    <select class="form-control guard_name" id="guard_name" style="width: 100%;">
                        <option value="admin" @if ($permission->guard_name == 'admin') selected @endif>الادمن</option>
                        <option value="institution" @if ($permission->guard_name == 'institution') selected @endif>المؤسسة</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" class="form-control" id="name" value="{{ $permission->name }}"
                        placeholder="ادخل الاسم ">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="update({{ $permission->id }})" class="btn btn-primary">تعديل</button>
            </div>
        </form>
    </div>


@endsection


@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin-asset/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.guards').select2({
            theme: 'bootstrap4'
        })
        function update(id) {
            axios.put('/admin/permissions/' + id, {
                    name: document.getElementById('name').value,
                    guard_name: document.getElementById('guard_name').value,
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = "/admin/permissions";
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message);
                })
        }
    </script>
@endsection

