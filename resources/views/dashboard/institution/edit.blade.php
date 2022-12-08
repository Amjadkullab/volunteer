@extends('dashboard.layouts.master')
@section('title', 'تعديل المؤسسة')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> المؤسسات والجمعيات</li>
    <li class="breadcrumb-item active">تعديل المؤسسة</li>
@endsection
@section('css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
    <div class="content">
        <form id="updated_form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>اسم المؤسسة</label>
                    <input type="text" name="name" id="name" @class(['form-control', 'is-invalid'=> $errors->has('name')]) value="{{ old('name', $institution->name) }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>صورة الغلاف</label>
                    <input type="file" name="cover_image" id="cover_image"  @class(['form-control', 'is-invalid'=> $errors->has('cover_image')])>
                    @if ($institution->cover_image)
                    <img src="{{ asset('uploads/cover_image/' . $institution->cover_image) }}" width="200">
                        @endif
                    @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>صورة اللوجو</label>
                    <input type="file" name="logo_image" id="logo_image" @class(['form-control', 'is-invalid'=> $errors->has('logo_image')])>
                    @if ($institution->logo_image)
                    <img src="{{ asset('uploads/logo_image/' . $institution->logo_image) }}" width="200">
                        @endif
                    @error('logo_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea name="description" id="description" @class(['form-control', 'is-invalid'=> $errors->has('description')]) cols="30">{{old('description',$institution->description)}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">الايميل</label>
                    <input type="email" name="email" class="form-control" id="email"  placeholder="أدخل الايميل " value="{{ old('email', $institution->email) }}">
                </div>
                <div class="form-group">
                    <label>اسم الدور </label>
                    <select class="form-control roles " id="role_id" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                  </div>



                                           <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"id="active"
                            @if ($institution->active)
                            checked
                            @endif>
                            <label class="custom-control-label" for="active">مفعل</label>
                        </div>
          

                    <div class="card-footer">

                        <button type="button" onclick="update({{$institution->id}})" class="btn btn-primary">تعديل</button>
                    </div>

            {{-- @method('PUT')
            @include('dashboard.institution._form',[
            'button_label' => 'تعديل'
            ]) --}}
        </form>
    </div>
@endsection
@section('scripts')
<script src="{{asset('admin-asset/plugins/select2/js/select2.full.min.js')}}"></script>
      <script>
             $('.guards').select2({
      theme: 'bootstrap4'
    })
    function update(id){
        let formData = new FormData;
        formData.append('_method','put');
        formData.append('name' , document.getElementById('name').value);
        if(document.getElementById('cover_image').files[0] != undefined ){
        formData.append('cover_image', document.getElementById('cover_image').files[0]);
        }
        if(document.getElementById('logo_image').files[0] != undefined ){
        formData.append('logo_image', document.getElementById('logo_image').files[0]);
        }
        formData.append('description' , document.getElementById('description').value);
        formData.append('email' , document.getElementById('email').value);
        formData.append('role_id' , document.getElementById('role_id').value);
        formData.append('active', document.getElementById('active').checked ? 1: 0);

        axios.post('/admin/institution/'+id,formData)

  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    document.getElementById('updated_form').reset();
  })
  .catch(function (error) {
    // handle error
    console.log(error);
    toastr.error(error.response.data.message);
  })
  .then(function () {
    // always executed
  });


    }


</script>

@endsection
