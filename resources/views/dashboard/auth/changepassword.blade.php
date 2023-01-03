@extends('dashboard.layouts.master')
@section('title', 'تغيير كلمة المرور')
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        {{-- <div class="card-header">
            {{-- <h3 class="card-title">تغيير كلمة المرور </h3> --}}
        {{-- </div> --}} 
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">كلمة المرور الحالية </label>
                    <input type="password" class="form-control" id="current_password"
                        value="{{ old('current_password') }}" placeholder="ادخل كلمة المرور الحالية">
                </div>

                <div class="form-group">
                    <label for="name">كلمة المرور الجديدة </label>
                    <input type="password" class="form-control" id="new_password" value="{{ old('new_password') }}"
                        placeholder="أدخل كلمة المرور الجديدة">
                </div>

                <div class="form-group">
                    <label for="name">تأكيد كلمة المرور  </label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        value="{{ old('new_password_confirmation') }}" placeholder="تأكيد كلمة المرور">
                </div>


            </div>

            <div class="card-footer">
                <button type="button" onclick="update()" class="btn btn-primary">تحديث</button>
            </div>
    </div>
    <!-- /.card-body -->
    </form>
</div>
<!-- /.card -->

</div>


@endsection
@section('scripts')
<script>
        function update(){
    axios.put('/admin/update-password',{
        current_password: document.getElementById('current_password').value,
        new_password:document.getElementById('new_password').value,
        new_password_confirmation:document.getElementById('new_password_confirmation').value
    })
        .then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
            // window.location.href="/cms/admin/categories";
        })
        .catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data.message);
        })
    }
</script>

@endsection
