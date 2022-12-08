<?php

namespace App\Http\Controllers;


use App\Models\admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function ShowLogin(Request $request, $guard)
    {

        return response()->view('dashboard.login',['guard'=> $guard]);
    }
    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3|max:10',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:admin,institution',
        ],[
            'guard.in' => 'please, Check login URL'
        ]);

        if (!$validator->fails()) {
            $credientials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];
            if (Auth::guard($request->get('guard'))->attempt($credientials, $request->get('remember'))) {
                return response()->json([
                    'message' => 'تم دخولك بنجاح ',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'فشلت عملية الدخول'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin':'institution';
        auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('login',$guard);
    }

    public function changePassword(){
        return response()->view('dashboard.auth.changepassword');
    }

    public function updatePassword(Request $request){
        $guard = auth('admin')->check() ? 'admin':'institution';
        $validatore = Validator($request->all(),[
            'current_password'=>"required|string|current_password",
            'new_password'=>'required|string|min:3|confirmed',
            // 'new_password_confirmation'=>
        ]);
        if(!$validatore->fails()){
            $user = auth($guard)->user();
            $user->password = Hash::make($request->get('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'message'=> $isSaved ? 'تم تحديث كلمة المرور بنجاح  ':'فشلت عملية تغيير كلمة المرور   '
            ],$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=>$validatore->getMessageBag()->first()
                ],Response::HTTP_BAD_REQUEST);
        }
    }

//    public function editProfile(){

//     //    $view = auth('admin')->check() ? 'admins.edit' : 'user.edit';
//        $view = auth('admin')->check() ? 'dashboard.admins.edit' : 'dashboard.Users.edit';
//        $guard = auth('admin')->check() ? 'admin' : 'institution' ;

//        return view($view, ['guard' =>auth($guard)->user()]);




//        }


//    public function make_new_admin(){
//     $admin = new admin();
//     $admin->name = 'Amjad';
//     $admin->email = 'Admin@gmail.com';
//     $admin->password = bcrypt("admin");
//     $admin->active = 1 ;
//     $admin->save();
//    }
}
