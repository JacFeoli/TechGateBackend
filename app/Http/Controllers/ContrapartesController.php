<?php

namespace App\Http\Controllers;

use App\Models\Contactos;
use App\Models\Representantes;
use App\Models\Beneficiarios_ESAL;
use App\Models\Representantes_ESAL;
use App\Models\Empresas;
use App\Models\Accionistas;
use App\Models\JuntaDirectiva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContrapartesController extends Controller
{
    public function index_contacto($id_formulario)
    {
        $resultado = Contactos::join("formularios", "contactos.id_formulario", "=", "formularios.id")
            ->where("contactos.id_formulario", $id_formulario)
            ->select("contactos.*")
            ->get();
        return ["data" => $resultado];
    }
    public function index_representante($id_formulario)
    {
        $resultado = Representantes::join("formularios", "representantes.id_formulario", "=", "formularios.id")
            ->where("representantes.id_formulario", $id_formulario)
            ->select("representantes.*")
            ->get();
        return ["data" => $resultado];
    }
    public function index_beneficiario_esal($id_formulario)
    {
        $resultado = Beneficiarios_ESAL::join("formularios", "beneficiarios_esal.id_formulario", "=", "formularios.id")
            ->where("beneficiarios_esal.id_formulario", $id_formulario)
            ->select("beneficiarios_esal.*")
            ->get();
        return ["data" => $resultado];
    }
    public function index_representante_esal($id_formulario)
    {
        $resultado = Representantes_ESAL::join("formularios", "representantes_esal.id_formulario", "=", "formularios.id")
            ->where("representantes_esal.id_formulario", $id_formulario)
            ->select("representantes_esal.*")
            ->get();
        return ["data" => $resultado];
    }
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
    public function register_contacto()
    {
        $result = new Contactos();
        $result->id_formulario = request()->id_formulario;
        $result->tipo_contacto = request()->tipo_contacto_c;
        $result->nombre = strtoupper(request()->nombre_contacto_c);
        $result->apellido = strtoupper(request()->apellido_contacto_c);
        $result->cargo = strtoupper(request()->cargo_contacto_c);
        $result->email = request()->correo_electronico_c;
        $result->telefono = request()->telefono_c;
        $result->telefono_movil = request()->telefono_movil_c;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function register_representante()
    {
        $result = new Representantes();
        $result->id_formulario = request()->id_formulario;
        $result->tipo_rol = request()->tipo_rol_r;
        $result->nombre = strtoupper(request()->representante_r);
        $result->tipo_identificacion = request()->tipo_documento_representante_r;
        $result->identificacion = request()->numero_documento_representante_r;
        $result->digito_verificacion = request()->digito_verificacion_r;
        $result->capital = request()->capital_representante_r;
        $result->pep = request()->pep_r;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function register_beneficiario_esal()
    {
        $result = new Beneficiarios_ESAL();
        $result->id_formulario = request()->id_formulario;
        $result->banco = request()->banco_beneficiario_esal;
        $result->tipo_cuenta = request()->tipo_cuenta_beneficiario_esal;
        $result->numero_cuenta = strtoupper(request()->numero_cuenta_beneficiario_esal);
        $result->nombre = strtoupper(request()->beneficiario_esal);
        $result->tipo_identificacion = request()->tipo_documento_beneficiario_esal;
        $result->identificacion = request()->numero_documento_beneficiario_esal;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function register_representante_esal()
    {
        $result = new Representantes_ESAL();
        $result->id_formulario = request()->id_formulario;
        $result->tipo_relcion = request()->tipo_relacion_representante_esal;
        $result->nombre = strtoupper(request()->representante_esal);
        $result->tipo_identificacion = request()->tipo_documento_representante_esal;
        $result->identificacion = request()->numero_documento_representante_esal;
        if ($result->save()) {
            return ["msj" => "Se ha registrado con exito", "id" => $result->id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
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
    public function delete_contacto($id)
    {
        $result = Contactos::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function delete_representante($id)
    {
        $result = Representantes::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function delete_beneficiario_esal($id)
    {
        $result = Beneficiarios_ESAL::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
        } else {
            return ["msj" => "Ocurrio un error"];
        }
    }
    public function delete_representante_esal($id)
    {
        $result = Representantes_ESAL::find($id);
        if ($result->delete()) {
            return ["msj" => "Se ha eliminado con exito", "id" => $id, "Status" => true];
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
