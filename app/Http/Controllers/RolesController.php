<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function index($buscar)
    {
        $buscar = $buscar == '0' ? '' : $buscar;
        $resultado = DB::table('roles')->where("nombre", "LIKE", "%$buscar%")->paginate(10);
        return ["data" => $resultado];
    }
    public function detail($buscar)
    {
        $usuarios = DB::table('roles')->where("id", $buscar)->first();
        return ["data" => $usuarios];
    }
    public function register()
    {
        $result = new Roles();
        $result->nombre = strtoupper(request()->nombre);
        $result->descripcion = strtoupper(request()->descripcion);
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function update()
    {
        $result = Roles::find(request()->id);
        $result->nombre = strtoupper(request()->nombre);
        $result->descripcion = strtoupper(request()->descripcion);
        if ($result->save()) {
            return ["msj" => "Se ha guardado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function delete($id)
    {
        $result = Roles::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
}
