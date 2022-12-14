<?php

namespace App\Controller;

use System\Controller;
use Peru\Jne\DniFactory;
use Peru\Sunat\RucFactory;

class ApiController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        // header('Access-Control-Allow-Credentials: true');
        // header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
        // header("Access-Control-Allow-Headers: X-Requested-With");
        // header('Content-Type: text/html; charset=utf-8');
        //https://api_dni_ruc.test/consulta?ruc=2045245853
        $data = $this->request()->getInput();

        if (isset($data->dni)) {
            if ($data->dni != '' && strlen($data->dni) == 8) {
                $dni = $data->dni;
                $result =  $this->dniGet($dni);
                //enviar http response

                echo json_encode($result);
                exit;
            } else {
                $data = [
                    'success' => false,
                    'message' => 'El DNI debe tener 8 dígitos'
                ];
                echo json_encode($data);
                exit;
            }
        } else if (isset($data->ruc)) {
            if ($data->ruc != '' && strlen($data->ruc) == 11) {
                $ruc = $data->ruc;
                $result = $this->rucGet($ruc);
                echo json_encode($result);
                exit;
            } else {
                $data = [
                    'success' => false,
                    'message' => 'El RUC debe tener 11 dígitos'
                ];
                echo json_encode($data);
                exit;
            }
        } else {
            $data = [
                'success' => false,
                'message' => 'No se encontró el parámetro de consulta'
            ];
            echo json_encode($data);
            exit;
        }
    }

    private function dniGet($dni)
    {
        $factory = new DniFactory();
        $cs = $factory->create();

        $person = $cs->get($dni);

        if ($person === null) {
            $data = [
                'success' => false,
                'message' => 'No se encontró el DNI'
            ];
            return $data;
        } else {
            $data = [
                'success' => true,
                'data' => [
                    'dni' => $person->dni,
                    'nombre' => $person->nombres . ' ' . $person->apellidoPaterno . ' ' . $person->apellidoMaterno,
                    'direccion' => '---',
                ]
            ];
            return $data;
        }
    }

    private function rucGet($ruc)
    {
        $factory = new RucFactory();
        $cs = $factory->create();

        $company = $cs->get($ruc);

        if ($company === null) {
            $data = [
                'success' => false,
                'message' => 'No se encontró el RUC'
            ];
            return $data;
        } else {
            $data = [
                'success' => true,
                'data' => [
                    'ruc' => $company->ruc,
                    'razonSocial' => $company->razonSocial,
                    'nombreComercial' => $company->nombreComercial,
                    'estado' => $company->estado,
                    'condicion' => $company->condicion,
                    'direccion' => $company->direccion,
                ]
            ];
            return $data;
        }
    }
}
