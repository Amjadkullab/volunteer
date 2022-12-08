<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Institution;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class InstitutionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Institution::class,'institution');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::withCount('permissions')->latest('id')->paginate(5);
        return view('dashboard.institution.index', compact('institutions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::where('guard_name','=','institution')->get();
        $institution = new Institution();

        return view('dashboard.institution.create',compact('institution'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(institution::rules(), [
            'required' => 'هذا الحقل  ايجباري',
            'min' => 'هذا الحقل ',
            'max' => 'هذا الحقل',
            'image' => 'هذا الحقل من نوع صورة'
        ]);
        $request->merge([
            'password' => Hash::make('password')
        ]);
        $data = $request->except('cover_image','password');
        $data['cover_image'] = $this->uploadImage($request);
        $data = $request->except('logo_image');
        $data['logo_image'] = $this->upload_Image($request);

     Institution::create($data);
    //   if($isSaved) assignRole(Role::findOrFail($request->input('role_id')));



        return redirect()->route('dashboard.institution.index')
            ->with('success', 'تم انشاء المؤسسة بنجاح!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institution = Institution::findorfail($id);
        return view('dashboard.institution.show', compact('institution'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $roles = Role::where('guard_name','=','institution')->get();
        $institution = Institution::findOrFail($id);
        // $roles =Role::where('guard_name','=','institution')->get();

        return view('dashboard.institution.edit',compact('institution'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(Institution::rules($id));

        $category = Institution::findOrFail($id);
        $old_image = $category->cover_image;

        $data = $request->except('cover_image');

        $new_image = $this->uploadImage($request);

        if ($new_image) {
            $data['cover_image'] = $new_image;
        }
        $old_image = $category->logo_image;

        $data = $request->except('logo_image');

        $new_image = $this->upload_Image($request);

        if ($new_image) {
            $data['logo_image'] = $new_image;
        }

        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }
        // if($isSaved) $data->syncRoles(Role::findOrFail($request->input('role_id')));
        return redirect()->route('dashboard.institution.index')
            ->with('success', 'تم تعديل المؤسسة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        return redirect()->route('dashboard.institution.index')
            ->with('danger', 'تم حذف المؤسسة بنجاح!');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('cover_image')) {
            return;
        }
        $file = $request->file('cover_image'); //UploadFile Object
        $path = $file->store('uploads/institution', [
            'disk' => 'public'
        ]);
        return $path;
    }
    protected function upload_Image(Request $request)
    {
        if (!$request->hasFile('logo_image')) {
            return;
        }
        $file = $request->file('logo_image'); //UploadFile Object
        $path = $file->store('uploads/institution_logo', [
            'disk' => 'public'
        ]);
        return $path;
    }

}
