<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'El Email y/o Contraseña digitados son incorrectos. Favor verificar información.'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el Token de acceso. Por favor comunicarse con el Administrador.'], 500);
        }
        $usuario = User::where('email', request('email'))->first();
        return response()->json(['datos' => $usuario, 'token' => $token, 'State' => true]);
        // return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function index($buscar)
    {
        $buscar = $buscar == '0' ? '' : $buscar;
        $usuarios = DB::table('users')
            ->join('roles', 'users.id_rol', '=', 'roles.id')
            ->where("users.name", "LIKE", "%$buscar%")
            ->select("users.name AS nombre",
                     "users.identification",
                     "users.identification_type",
                     "users.email",
                     "users.position",
                     "users.blocked",
                     "users.id AS id",
                     "roles.id AS id_rol",
                     "roles.nombre as rol")
            ->paginate(10);
        return ["data" => $usuarios];
    }

    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->toJson(), 400);
        // }
        // $user = User::create([
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     'password' => Hash::make($request->get('password'))
        // ]);
        // $token = JWTAuth::fromUser($user);
        // return response()->json(compact('user', 'token'), 201);

        $validar = User::where("email", "=", request()->email)->first();
        if ($validar) {
            return ["msj" => "El Usuario con Correo Electrónico: " . request()->email . " ya existe creado. Favor verificar información."];
        }
        if (request()->password1 != request()->password2) {
            return ["msj" => "Las Contraseñas digitadas no coinciden. Favor verificar información."];
        }
        $user = new User();
        $user->name = strtoupper(request()->nombre);
        $user->identification_type = request()->tipo_identificacion;
        $user->identification = request()->identificacion;
        $user->email = strtolower(request()->correo_electronico);
        $user->password = Hash::make(request()->password1);
        $user->position = strtoupper(request()->cargo);
        $user->blocked = request()->estado;
        $user->id_rol = request()->id_rol;
        if ($user->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $user->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }

    public function update()
    {
        $user = User::find(request()->id);
        $user->name = strtoupper(request()->nombre);
        $user->identification_type = request()->identification_type;
        $user->identification = request()->identificacion;
        $user->email = strtolower(request()->correo_electronico);
        $user->position = strtoupper(request()->cargo);
        $user->blocked = request()->blocked;
        $user->id_rol = request()->id_rol;
        if (request()->password1 != '') {
            $user->password = bcrypt(request()->password1);
        }
        if ($user->save()) {
            return ["msj" => "Se ha guardado con exito", "id" => $user->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }

    public function detail($buscar)
    {
        $usuarios = DB::table('users')->where("id", $buscar)->first();
        return ["data" => $usuarios];
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $user->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }

    public function roles()
    {
        $resultado = DB::table('roles')->get();
        return ["data" => $resultado];
    }
}
