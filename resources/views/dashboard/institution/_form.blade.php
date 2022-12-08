<div class="form-group">
    <label>اسم المؤسسة</label>
    <input type="text" name="name" @class(['form-control', 'is-invalid'=> $errors->has('name')]) value="{{ old('name', $institution->name) }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>صورة الغلاف</label>
    <input type="file" name="cover_image" @class(['form-control', 'is-invalid'=> $errors->has('cover_image')])>
    @if ($institution->cover_image)
    <img src="{{ asset('storage/' . $institution->cover_image) }}" width="200">
        @endif
    @error('cover_image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>صورة اللوجو</label>
    <input type="file" name="logo_image" @class(['form-control', 'is-invalid'=> $errors->has('logo_image')])>
    @if ($institution->logo_image)
    <img src="{{ asset('storage/' . $institution->logo_image) }}" width="200">
        @endif
    @error('logo_image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>الوصف</label>
    <textarea name="description" @class(['form-control', 'is-invalid'=> $errors->has('description')]) cols="30">{{old('description',$institution->description)}}</textarea>
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="email">الايميل</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="أدخل الايميل ">
</div>
{{-- <div class="form-group">
    <label>اختر الدور</label>
    <select class="form-control roles" id="role_id">
        @foreach ($roles as $role )
        <option value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
    </select>
  </div> --}}


<div class="col-md-6">
    <div class="form-group">
       <label for="active"> حالة التفعيل</label>
      <select name="active" id="active" class="form-control" >
        <option value="">اختر الحالة</option>
        <option @if (old('active')==1 || old('active')=="") selected = "selected" @endif  value="1"> مفعل</option>
        <option @if (old('active')==0 and old('active')!= "") selected = "selected" @endif value="0"> معطل </option>
      </select>
        @error('active')
        <span class="text-danger" >{{ $message }}</span>
        @enderror
    </div>
    </div>
<div class="py-3">
    <button class="btn btn-outline-success">{{ $button_label ?? 'حفظ' }} </button>
</div>
