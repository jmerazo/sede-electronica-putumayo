<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Person;

class ServersDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Paginación de Funcionarios con filtro opcional
        $funcionarios = Funcionario::when($search, function ($query, $search) {
                            $query->where('nombres', 'like', "%{$search}%")
                                  ->orWhere('apellidos', 'like', "%{$search}%")
                                  ->orWhere('cargo', 'like', "%{$search}%")
                                  ->orWhere('dependencias', 'like', "%{$search}%");
                        })
                        ->orderBy('nombres')
                        ->paginate(6); // Cambia este valor según el número deseado de registros por página
    
        // Paginación de Contratistas con filtro opcional
        $personas = Person::when($search, function ($query, $search) {
                            $query->where('name', 'like', "%{$search}%")
                                  ->orWhere('role', 'like', "%{$search}%")
                                  ->orWhere('email', 'like', "%{$search}%")
                                  ->orWhere('phone', 'like', "%{$search}%");
                        })
                        ->orderBy('name')
                        ->paginate(6);
    
        $sigepInfo = "
                Art. 9 Ley 1712 de 2014 en concordancia con Decreto 1081 de 2015 Art. 2.1.1.2.1.5.
                Directorio de Información de servidores públicos, empleados y contratistas.
                PARÁGRAFO 1. Para las entidades u organismos públicos, el requisito se entenderá cumplido con 
                publicación de la información que contiene el directorio en el Sistema de Gestión del Empleo Público (SIGEP),
                de que trata el artículo 18 de la Ley 909 de 2004 y las normas que la reglamentan.
                
                Ingrese al siguiente <a href='https://www.funcionpublica.gov.co/dafpIndexerBHV/hvSigep/index?find=FindNext&query=putumayo&dptoSeleccionado=&entidadSeleccionado=4415&munSeleccionado=&tipoAltaSeleccionado=&bloquearFiltroDptoSeleccionado=&bloquearFiltroEntidadSeleccionado=&bloquearFiltroMunSeleccionado=&bloquearFiltroTipoAltaSeleccionado='>Enlace</a> para consultar la información de cada uno de los servidores públicos y contratistas.";                   
    
        return view('servers_directory', compact('funcionarios', 'personas', 'sigepInfo', 'search'));
    }
}
