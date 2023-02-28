<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showlogin()
    {
        return response()->view('cms.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(),[
            'email' => 'required|string|email|exists:admins,email',
            'password' => 'required|string|max:100',
            'remember' => 'required'
        ]);

        if (!$validator->fails()) {
            $validationfaild =['email'=> $request->input('email'),'password'=> $request->input('password')];
            if(Auth::guard('admin')->attempt($validationfaild, $request->input('remember'))) {

                return response()->json(
                    ['message'=> 'Logged in successfully'],
                    Response::HTTP_OK
                );
            } else {
                return response()->json(
                    ['message'=> 'Check Email Or Password then try again'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['message'=> $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );

        }

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->guest(route('auth.login'));
    }
}
