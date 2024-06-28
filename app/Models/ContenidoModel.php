<?php

namespace App\Models;

use CodeIgniter\Model;

class ContenidoModel extends Model
{
    protected $table = 'contenidos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'titulo', 'palabras_clave', 'area_conocimiento', 'tipo_contenido',
        'imagen_portada', 'imagen_previa', 'descripcion', 'contenido_html'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_actualizacion';
}
