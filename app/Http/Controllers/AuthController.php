<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
{
    $user = new User;
    $user->email = $request->email;
    $user->name = $request->name;
    $user->password = bcrypt($request->password);
    $user->save();
    return response([
        'status' => 'sucesso',
        'data' => $user
       ], 200);
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'erro',
                'error' => 'invalido',
                'msg' => 'Invalido.'
            ], 400);
    } 
    return response([
            'status' => 'sucesso',
            'token' => $token
        ]);
}

public function user(Request $request)
{
    $user = User::find(Auth::user()->id);
    return response([
            'status' => 'sucesso',
            'data' => $user
        ]);
}
public function logout()
{
    JWTAuth::invalidate();
    return response([
            'status' => 'sucesso',
            'msg' => 'Logged out Successfully.'
        ], 200);
}

public function postproduto()
{
    $produto = new Produto;
    $produto->Title = $request->title;
    $produto->Type = $request->type;
    $produto->Rating = $request->rating;
    $produto->Price = $request->price;
    $produto->save();
    return response([
            'status' => 'successo',
            'msg' => 'Sucesso'
        ], 200);
}

public function putproduto()
{
    $id = Route::current()->getParameter('productId');
    $Title = $request->title;
    $Type = $request->type;
    $Rating = $request->rating;
    $Price = $request->price;
    DB::table('teste')
    ->where('id', $id)
    ->update(['Title' => $Title],['Type' => $Type],['Rating' => $Rating],['Price' => $Price]);
}

public function deleteproduto()
{
    $id = Route::current()->getParameter('productId');
    $res = DB::table('teste')->where('id', $id)->delete();
    return Response::json($res);

}

public function produtosid()
{
    $id = Route::current()->getParameter('productId');
    $res = DB::table('teste')->where('id', $id)->first();
    return Response::json($res);
}
public function getproduto()
{
    $res = DB::table('teste')->get();
    return Response::json($res);
}



public function refresh()
{
    return response([
     'status' => 'sucesso'
    ]);
}
}
 