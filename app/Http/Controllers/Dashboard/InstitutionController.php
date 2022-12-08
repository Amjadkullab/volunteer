<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Institution;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

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
        $institutions = Institution::with('roles')->latest('id')->paginate(5);
        return view('dashboard.institution.index', compact('institutions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name','=','institution')->get();
        $institution = new Institution();

        return view('dashboard.institution.create',compact('roles','institution'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:255',
            'cover_image' => 'image',
            'logo_image' => 'image',
            'description' => 'required|string|min:3',
            'active' =>'required',
            'email'=>'required',
            'role_id'=>'required|numeric|exists:roles,id',

            ]);
            if(!$validator->fails()){
        $institution = new Institution();
        $institution->name= $request->get('name');
        $ex = $request->file('cover_image')->getClientOriginalExtension();
        $new_img_name = 'System_tasks'.'.'. time(). '.' . $ex;
        $request->file('cover_image')->move(public_path('uploads/cover_image/'),$new_img_name );
        $institution->cover_image = $new_img_name;
        $e = $request->file('logo_image')->getClientOriginalExtension();
        $new_img_name1 = 'System_tasks'.'.'. time(). '.' . $e;
        $request->file('logo_image')->move(public_path('uploads/logo_image/'),$new_img_name1 );
        $institution->logo_image = $new_img_name1;
        $institution->description= $request->get('description');
        $institution->active= $request->get('active');
        $institution->email= $request->get('email');
        $institution->password= Hash::make('password');
        $isSaved = $institution->save();
        if($isSaved)$institution->assignRole(Role::findOrFail($request->input('role_id')));
    //     $request->merge([
    //         'password' => Hash::make('password')
    //     ]);
    //     $data = $request->except('cover_image','password');
    //     $data['cover_image'] = $this->uploadImage($request);
    //     $data = $request->except('logo_image');
    //     $data['logo_image'] = $this->upload_Image($request);

    // $isSaved =  Institution::create($data);
    //   if($isSaved) {assignRole(Role::findOrFail($request->input('role_id')));}

    return response()->json([
        'message' => $isSaved ? "تمت الاضافة بنجاح " : "فشلت الاضافة ",

    ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

} else{
    return response()->json([
        'message' => $validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);


}

    //     return redirect()->route('dashboard.institution.index')
    //         ->with('success', 'تم انشاء المؤسسة بنجاح!');
    // }
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
    public function edit(Institution $institution)
    {
        $roles = Role::where('guard_name','=','institution')->get();
        // $roles =Role::where('guard_name','=','institution')->get();

        return view('dashboard.institution.edit',compact('roles','institution'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:255',
            'cover_image' => 'nullable|image',
            'logo_image' => 'nullable|image',
            'description' => 'required|string|min:3',
            'active' =>'required',
            'email'=>'required',
            'role_id'=>'required|numeric|exists:roles,id',

            ]);
            // $institution = new Institution();
            if(!$validator->fails()){
            $institution->name= $request->get('name');

            $new_img_name = $institution->cover_image ;
            if($request->has('cover_image')){
                $ex = $request->file('cover_image')->getClientOriginalExtension();
                $new_img_name = 'System_tasks'.'.'. time(). '.' . $ex;
                $request->file('cover_image')->move(public_path('uploads/cover_image/'),$new_img_name );
                $institution->image = $new_img_name;}

            $new_img_name1 = $institution->logo_image ;
            if($request->has('logo_image')){
                $e = $request->file('logo_image')->getClientOriginalExtension();
                $new_img_name1 = 'System_tasks'.'.'. time(). '.' . $e;
                $request->file('logo_image')->move(public_path('uploads/logo_image/'),$new_img_name1 );
                $institution->image = $new_img_name1;}

            $institution->description= $request->get('description');
            $institution->active= $request->get('active');
            $institution->email= $request->get('email');
            $institution->password= Hash::make('password');


        $isSaved = $institution->save();
         if($isSaved) $institution->syncRoles(Role::findOrFail($request->input('role_id')));
        // $old_image = $category->cover_image;

        // $data = $request->except('cover_image');

        // $new_image = $this->uploadImage($request);

        // if ($new_image) {
        //     $data['cover_image'] = $new_image;
        // }
        // $old_image = $category->logo_image;

        // $data = $request->except('logo_image');

        // $new_image = $this->upload_Image($request);

        // if ($new_image) {
        //     $data['logo_image'] = $new_image;
        // }

        // $category->update($data);

        // if ($old_image && $new_image) {
        //     Storage::disk('public')->delete($old_image);
        // }
        return response()->json([
            'message' => $isSaved ? "تم التعديل بنجاح " : "فشل التعديل ",


        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);



    } else{
        return response()->json([
            'message' => $validator ->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);


    }
        // return redirect()->route('dashboard.institution.index')
        //     ->with('success', 'تم تعديل المؤسسة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        // if(auth('admin')->id != $admin->id){
        $isDeleted = $institution->delete();
       if($isDeleted){
        return response()->json([
            'icon'=> 'success',
            'title'=> 'نجحت العملية!',
            'text'=> 'تم الحذف بنجاح '
        ], Response::HTTP_OK);
       } else{
        return response()->json([
            'icon'=> 'error',
            'title'=> 'فشلت العملية!',
            'text'=> 'فشل الحذف ، لا يمكن حذف حسابك'
        ], Response::HTTP_BAD_REQUEST);

       }
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
