<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Juego extends Controller
{
    public function index()
    {
        return view('Juego/principal');
    }

    public function nivel($nivel = 1)
    {
        if ($nivel < 1 || $nivel > 4) {
            return redirect()->to('juego/nivel/1');
        }

        $data = [
            'nivel' => $nivel,
            'cantidad' => $this->generarCantidad($nivel),
            'inicial' => ($nivel === 2 || $nivel === 3 || $nivel === 4) ? $this->generarBilletesIniciales($nivel) : []
        ];

        return view('juego/juego_nivel', $data);
    }

    private function generarCantidad($nivel)
    {
        return $nivel === 4 ? rand(1, 9999) : rand(1, 999);
    }

    private function generarBilletesIniciales($nivel)
    {
        $billetes = [1000, 100, 10, 1];
        $iniciales = [];

        foreach ($billetes as $billete) {
            $cantidadInicial = rand(0, 9);
            for ($i = 0; $i < $cantidadInicial; $i++) {
                $iniciales[] = $billete;
            }
        }

        return $iniciales;
    }

}