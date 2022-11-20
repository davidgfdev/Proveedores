<?php

namespace App\Controller;

use App\Entity\Proveedor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        $proveedor = new Proveedor();
        $proveedor->setNombre("David Guerrero");
        $proveedor->setCorreo("davidgf.dev@gmail.com");
        $proveedor->setTelefono("977225432");
        $proveedor->setTipo("hotel");
        $proveedor->setActivo(true);
        return $this->render('proveedores/homepage.html.twig', [
            'title' => 'Proveedores',
            'proveedor' => $proveedor,

        ]);
    }



    /**
     * @Route("/create", name="Main")
     */
    public function create()
    {
        return $this->render('proveedores/formpage.html.twig', [
            'title' => 'Crear/Editar Proveedor'
        ]);
    }
}