<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Formularios;
use Illuminate\Support\Facades\DB;

class FormulariosController extends Controller
{
    public function index($buscar)
    {
        $buscar = $buscar == '0' ? '' : $buscar;
        $resultado = Formularios::join("users", "formularios.id_usuario", "=", "users.id")
            ->where("users.name", "LIKE", "%$buscar%")
            // ->where("formularios.id_empresa", $id_empresa)
            ->select("formularios.*", "users.id AS id_usuario", "users.name", "users.identification")
            ->paginate(10);
        return ["data" => $resultado];
    }
    public function detail($buscar)
    {
        $formulario = Formularios::where("id", $buscar)->first();
        return ["data" => $formulario];
    }
    public function register()
    {
        $result = new Formularios();
        $result->id_empresa = 1;
        $result->id_usuario = request()->id_usuario;
        $result->tipo_tercero = request()->tipo_tercero;
        $result->tipo_sociedad = request()->tipo_sociedad;
        $result->primera_vez = 1;
        $result->estado = 1;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function update()
    {
        $result = Formularios::find(request()->id);
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
        $result = Formularios::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function activate()
    {
        $result = Formularios::where("id_empresa", "=", request()->id_empresa)
            ->where("id_usuario", "=", request()->id_usuario)
            ->where("tipo_tercero", "=", request()->tipo_tercero)
            ->first();
        if ($result) {
            $result->estado = request()->estado;
            if ($result->save()) {
                return ["msj" => "Se ha activado el Formulario con Éxito", "Status" => true];
            } else {
                return ["msj" => "Ocurrio un error"];
            }
        } else {
            return ["msj" => "El formulario solicitado no existe. Favor verificar información", "Status" => true];
        }
        return $result;
    }
}
