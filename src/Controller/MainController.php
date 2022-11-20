<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        //$proveedor = new Proveedor("David Guerrero", "davidgf.dev@gmail.com", tipoProveedor::hotel, true);
        return $this->render('proveedores/homepage.html.twig', [
            'title' => 'Proveedores',
            //'proveedor' => $proveedor,

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