<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costos; // Asegúrate de importar el modelo Costos

class CostosController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los costos
        // Por ejemplo, podrías usar un modelo para obtener los datos de la base de datos
        // return Costos::all();

        // Si tienes un modelo Costos, puedes descomentar la siguiente línea:
         $costos = Costos::all();

        // Retorna la vista con los costos
        return view('pages.costos',['costos' => $costos]); // Asegúrate de que 'pages.costos' sea la vista correcta
    }
}
