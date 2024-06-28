<?php

namespace App\Controllers;

use App\Models\ContenidoModel;
use CodeIgniter\RESTful\ResourceController;

class Contenidos extends ResourceController
{
    protected $modelName = 'App\Models\ContenidoModel';
    protected $format    = 'json';

    public function __construct()
    {
        $this->model = new ContenidoModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        $contenidos = $this->model->orderBy('fecha_creacion', 'desc')->findAll(6);
        return view('contenidos/index', ['contenidos' => $contenidos]);
    }

    public function show($id = null)
    {
        $contenido = $this->model->find($id);
        return view('contenidos/show', ['contenido' => $contenido]);
    }

    public function admin()
    {
        $contenidos = $this->model->orderBy('titulo', 'asc')->findAll();
        return view('contenidos/admin', ['contenidos' => $contenidos]);
    }

    public function create()
    {
        return view('contenidos/form');
    }

    public function store()
    {
        $data = $this->request->getPost();

        // Manejar carga de imagen de portada
        if ($img = $this->request->getFile('imagen_portada')) {
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'uploads', $newName);
                $data['imagen_portada'] = $newName;
            }
        }

        // Manejar carga de imagen previa
        if ($thumb = $this->request->getFile('imagen_previa')) {
            if ($thumb->isValid() && !$thumb->hasMoved()) {
                $newName = $thumb->getRandomName();
                $thumb->move(ROOTPATH . 'uploads', $newName);
                $data['imagen_previa'] = $newName;
            }
        }

        $this->model->insert($data);
        return redirect()->to(site_url('contenidos/admin'));
    }

    public function edit($id = null)
    {
        $contenido = $this->model->find($id);
        return view('contenidos/form', ['contenido' => $contenido]);
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Manejar carga de imagen de portada
        if ($img = $this->request->getFile('imagen_portada')) {
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'uploads', $newName);
                $data['imagen_portada'] = $newName;
            }
        }

        // Manejar carga de imagen previa
        if ($thumb = $this->request->getFile('imagen_previa')) {
            if ($thumb->isValid() && !$thumb->hasMoved()) {
                $newName = $thumb->getRandomName();
                $thumb->move(WRITEPATH . 'uploads', $newName);
                $data['imagen_previa'] = $newName;
            }
        }

        $this->model->update($id, $data);
        return redirect()->to(site_url('contenidos/admin'));
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/contenidos/admin');
    }

    //Funciones para el REST

    public function listaContenidosPortada()
    {
        $contenidos = $this->model->orderBy('id', 'desc')->findAll(6);
        return $this->respond($contenidos);
    }

    public function listaContenidos()
    {
        $contenidos = $this->model->orderBy('titulo', 'asc')->findAll();
        return $this->respond($contenidos);
    }

    public function verContenido($id = null)
    {
        $contenido = $this->model->find($id);
        if ($contenido) {
            return $this->respond($contenido);
        }
        return $this->failNotFound('Contenido no encontrado');
    }

    public function nuevoContenido()
    {
        $data = $this->request->getPost();
        $this->model->insert($data);
        $id = $this->model->insertID();
        return $this->respondCreated(['id' => $id]);
    }

    public function actualizarContenido($id = null)
    {
        $data = $this->request->getPost();
        $this->model->update($id, $data);
        return $this->respond(['status' => 'success']);
    }

    public function juego()
    {
        return view('contenidos/juego');
    }
}
