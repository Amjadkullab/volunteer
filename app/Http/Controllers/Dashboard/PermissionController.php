<?php

namespace App\Http\Controllers\Dashboard;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PermissionController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Permission::class,'permission');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
       return response()->view('dashboard.Spatie.Permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dashboard.Spatie.Permissions.create');
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
            'name' => 'required|string|min:3|max:300',
            'guard_name'=> 'required|string|in:admin,institution'
         ]);
         if(!$validator->fails()){
            $permission = new Permission();
            $permission->name = $request->get('name');
            $permission->guard_name = $request->get('guard_name');
            $isSaved = $permission->save();
            return response()->json([
                'message' => $isSaved ? 'تمت عملية الاضافة بنجاح ' : 'فشلت عملية الاضافة  '
            ],  $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
         }  else {
            return response()->json([
    'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
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
    public function edit(Permission $permission)
    {
        return response()->view('dashboard.Spatie.Permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validatore = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'guard_name' => 'required|string|in:admin,institution'
        ]);
        if (!$validatore->fails()) {
            $permission->name = $request->get('name');
            $permission->guard_name = $request->get('guard_name');
            $isSaved = $permission->save();
            return response()->json([
                'message' => $isSaved ? 'تمت عملية التعديل بنجاح ' : 'فشلت عملية التعديل  '
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validatore->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {

        $isDeleted = $permission->delete();
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
