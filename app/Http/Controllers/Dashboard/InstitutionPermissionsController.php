<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Institution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class InstitutionPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $institution)
    {


        $permissions = Permission::where('guard_name', 'institution')->get();
        $userPermissions = $institution->permissions()->get();
        if(count($userPermissions) > 0){
            foreach($permissions as $permission){
                $permission->setAttribute('assigned', false);
                foreach($userPermissions as $userPermission){
                    if($permission->id == $userPermission->id){
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }
        return view('dashboard.institution.institutionPermissions', compact('institution','permissions','userPermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Institution $institution)
    {
        {
            $validator = Validator( $request->all(),[
                'permission_id' => 'required|integer|exists:permissions,id',
            ]);

            if(!$validator->fails()){
                $permission = Permission::findOrFail($request->get('permission_id'));
                if($institution->hasPermissionTo($permission)){
                    $institution->revokePermissionTo($permission);
                }else{
                    $institution->givePermissionTo($permission);
                }
                return response()->json([
                    'message'=>'تم تحديث الصلاحية بنجاح '
                ],Response::HTTP_OK);
            }else {
                return response()->json([
                    'message'=>$validator->getMessageBag()->first()
                ],Response::HTTP_BAD_REQUEST);
            }
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
