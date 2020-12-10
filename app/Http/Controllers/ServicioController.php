<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;

class ServicioController extends Controller
{
    public function getServices() {
        $dat = new Servicio();
        return $dat->all();
    }
}
