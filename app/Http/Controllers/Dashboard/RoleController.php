<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class RoleController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Role::class,'role');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withcount('permissions')->get();
      return response()->view('dashboard.Spatie.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dashboard.Spatie.roles.create');
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
            'name' => 'required|string',
            'guard_name' => 'required|string|in:admin,institution',
          ]);
          if(!$validator->fails()){
               $role = new Role();
               $role->name= $request->get('name');
               $role->guard_name = $request->get('guard_name');
               $issaved = $role->save();
                  return response()->json([
                      'message' => $issaved ? 'تمت الاضافة بنجاح ' : 'فشلت الاضافة'
                  ],$issaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

               }else{
                  return response()->json([
                      'message' =>$validator->getMessageBag()->first()
                  ],Response::HTTP_BAD_REQUEST);
               }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $guards = ['admin', 'institution'];
        return response()->view('dashboard.Spatie.roles.edit', compact('role', 'guards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validatore = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'guard_name' => 'required|string|in:admin,institution'
        ]);
        if (!$validatore->fails()) {
            $role->name = $request->input('name');
            $role->guard_name = $request->input('guard_name');
            $isUpdate = $role->save();
            if ($isUpdate) {
                $isUpdate = $role->save();
                return response()->json([
                    'message' => $isUpdate ? 'تم التعديل بنجاح ' : ' فشلت عملية التعديل '
                ], $isUpdate ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'message' => $validatore->getMessageBag()->first()
                ], Response::HTTP_BAD_REQUEST);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $isDeleted = $role->delete();
        if ($isDeleted) {
            return response()->json([
                'title' => 'نجحت عملية الحذف', 'text' => 'تم الحذف بنجاح ', 'icon' => 'success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'title' => 'فشلت عملية الحذف', 'text' => 'فشلت العملية ', 'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
