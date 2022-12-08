<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function __construct(){
        $this->authorizeResource(admin::class,'admin');
    }


    public function index()
    {

        $admins = admin::with('roles')->get();
        return view('dashboard.admins.index',compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name','=','admin')->get();
        return view('dashboard.admins.create',compact('roles'));
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
        'name'=> 'required|string|min:3|max:30',
        'email' => 'required|string',
        'active' => 'required|boolean',
        'role_id'=>'required|numeric|exists:roles,id',


        ]);

        if(!$validator->fails()){

         $admin = new admin();
         $admin->name= $request->get('name');
         $admin->email= $request->get('email');
         $admin->password= Hash::make('password');
         $admin->active= $request->get('active');
         $isSaved = $admin->save();
         if($isSaved)$admin->assignRole(Role::findOrFail($request->input('role_id')));
        //  Mail::to($admin->email)->send(new WelcomeEmail($admin));
         return response()->json([
            'message' => $isSaved ? "تمت الاضافة بنجاح " : "فشلت الاضافة ",

        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

    } else{
        return response()->json([
            'message' => $validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);


    }
 }






    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        $roles = Role::where('guard_name','=','admin')->get();
        return view('dashboard.admins.edit', compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        $validator = Validator($request->all(),[

        'name'=>'required|string|min:3|max:30',
        'email' => 'required|string',
        'active' => 'required|boolean'

        ]);

        if(!$validator->fails()){
         $admin->name = $request->get('name');
         $admin->email= $request->get('email');
         $admin->password= Hash::make('password');
         $admin->active= $request->get('active');
        $isUpdated = $admin->save();
        if($isUpdated) $admin->syncRoles(Role::findOrFail($request->input('role_id')));
         return response()->json([
            'message' => $isUpdated ? "تم التعديل بنجاح " : "فشل التعديل ",

        ], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

    } else{
        return response()->json([
            'message' => $validator ->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);


    }
 }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        // if(auth('admin')->id != $admin->id){
        $isDeleted = $admin->delete();
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

}
