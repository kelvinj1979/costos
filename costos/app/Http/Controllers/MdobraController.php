<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mdobra; // Asegúrate de importar el modelo Mdobra

class MdobraController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los datos de mano de obra
        // Por ejemplo, podrías usar un modelo para obtener los datos de la base de datos
        // return Mdobra::all();
        $mdobra = Mdobra::all(); // Reemplaza esto con tu lógica para obtener los datos de mano de obra

        return view('pages.mdobra', ['mdobra' => $mdobra]);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de mano de obra
        return view('pages.create_mdobra');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar un nuevo registro de mano de obra
        // Validar y guardar el registro en la base de datos
    }
}
