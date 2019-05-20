<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class BahraController extends Controller
{
	protected $url;
	protected $body;


	protected $apiKey;
    protected $curl;
    protected $header;
    protected $httpResultado;
    protected $httpCode;


public function __construct()
{
	$this->header = [
            'Content-Type: application/json',
        ];
}


public function getProvincias()
{
		//$this->url = 'https://apis.datos.gob.ar/georef/api/localidades?municipio=060408&max=1000';
		//$this->url = 'https://apis.datos.gob.ar/georef/api/municipios?provincia=06&max=1000';
		$this->url = 'https://apis.datos.gob.ar/georef/api/provincias?max=1000';


		# Abro conexión
        $this->_init($this->url);

        # Método
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'GET');

        # Si tiene parámetros en el body
        if (count($this->body) > 0)
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($this->body));

        # Ejecuto
        $this->httpResultado = $this->_exec();
        $this->httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        # Cierro
        $this->_close();

    dd(json_decode($this->httpResultado));

}

protected function _close()
    {
        curl_close($this->curl);
    }


protected function _exec()
    {
        return curl_exec($this->curl);
    }

protected function _init($url)
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->header);
        //esto es para windows
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        //
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }


}