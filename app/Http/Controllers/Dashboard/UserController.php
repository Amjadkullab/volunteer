<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('id','!=', auth('admin')->id())->get();
        return view('Dashboard.Users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Users.create');
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
            'active' => 'required|boolean'


            ]);

            if(!$validator->fails()){

             $admin = new User();
             $admin->name= $request->get('name');
             $admin->email= $request->get('email');
             $admin->password= Hash::make('password');
             $admin->active= $request->get('active');
             $isSaved = $admin->save();
            //  Mail::to($admin->email)->send(new WelcomeEmail($admin));
             return response()->json([
                'message' => $isSaved ? "تمت عملية الاضافة بنجاح " : "فشلت عملية الاضافة ",

            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        } else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);


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
        $user = User::findorfail('id')->get();

        return view('Dashboard.Users.edit', compact('user'));
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
        $user = User::findorfail('id')->get();
        $validator = Validator($request->all(),[

            'name'=>'required|string|min:3|max:30',
            'email' => 'required|string',
            'active' => 'required|boolean'

            ]);

            if(!$validator->fails()){
             $user->name = $request->get('name');
             $user->email= $request->get('email');
             $user->password= Hash::make('password');
             $user->active= $request->get('active');
            $isUpdated = $user->save();
             return response()->json([
                'message' => $isUpdated ? "تمت عملية التعديل بنجاح " : " فشلت عملية التعديل",

            ], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        } else{
            return response()->json([
                'message' => $validator ->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail('id')->get();
        $isDeleted = $user->delete();
        if($isDeleted){
         return response()->json([
             'icon'=> 'success',
             'title'=> 'نجحت عملية الحذف!',
             'text'=> 'تم الحذف بنجاح '
         ], Response::HTTP_OK);
        } else{
         return response()->json([
             'icon'=> 'error',
             'title'=> 'فشلت عملية الحذف!',
             'text'=> 'فشلت العملية '
         ], Response::HTTP_BAD_REQUEST);

        }
    }

}
