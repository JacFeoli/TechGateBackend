<?php

namespace App\Http\Controllers;

use App\Models\Accionistas;
use App\Models\Empresas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\JuntaDirectiva;
use Illuminate\Support\Facades\DB;

class ContrapartesController extends Controller
{
    public function index_accionista($id_formulario)
    {
        $resultado = Accionistas::join("formularios", "accionistas.id_formulario", "=", "formularios.id")
            ->where("accionistas.id_formulario", $id_formulario)
            ->select("accionistas.*")
            ->get();
        return ["data" => $resultado];
    }
    public function index_junta_directiva($id_formulario)
    {
        $resultado = JuntaDirectiva::join("formularios", "junta_directiva.id_formulario", "=", "formularios.id")
            ->where("junta_directiva.id_formulario", $id_formulario)
            ->select("junta_directiva.*")
            ->get();
        return ["data" => $resultado];
    }
    public function register_accionista()
    {
        $result = new Accionistas();
        $result->id_formulario = request()->id_formulario;
        $result->nombre = strtoupper(request()->accionista_ae);
        $result->tipo_identificacion = request()->tipo_documento_accionista_ae;
        $result->identificacion = request()->numero_documento_accionista_ae;
        $result->digito_verificacion = request()->digito_verificacion_ae;
        $result->capital = request()->capital_accionista_ae;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function register_junta_directiva()
    {
        $result = new JuntaDirectiva();
        $result->id_formulario = request()->id_formulario;
        $result->nombre = strtoupper(request()->miembro_junta_directiva_jd);
        $result->tipo_identificacion = request()->tipo_documento_miembro_junta_directiva_jd;
        $result->identificacion = request()->numero_documento_miembro_junta_directiva_jd;
        $result->digito_verificacion = request()->digito_verificacion_jd;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function register_empresas()
    {
        $result = new Empresas();
        $result->nombre = strtoupper(request()->nombre);
        $result->nit = request()->nit;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function delete_accionista($id)
    {
        $result = Accionistas::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function delete_junta_directiva($id)
    {
        $result = JuntaDirectiva::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
}
