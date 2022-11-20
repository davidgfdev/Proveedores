<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Proveedor::class);

        $proveedores = $repo->findAll();

        return $this->render('proveedores/homepage.html.twig', [
            'title' => 'Proveedores',
            'proveedores' => $proveedores,
        ]);
    }

    /**
     * @Route("/delete/{id}")
     */
    public function delete(string $id, EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Proveedor::class);
        $proveedor = $repo->find($id);

        $em->remove($proveedor);
        $em->flush();
        return $this->render('proveedores/resultform.html.twig', [
            'title' => 'Eliminado',
            'text' => 'Proveedor ' . $proveedor->getNombre() . " eliminado con éxito.",
        ]);
    }


    /**
     * @Route("/form/{id}", name="Form")
     */
    public function create(string $id, Request $request, EntityManagerInterface $em)
    {
        if ($id == "-1") {

            $proveedor = new Proveedor();

            $form = $this->createForm(ProveedorType::class, $proveedor);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $proveedor->setFechaCreacion(new \DateTime());
                $proveedor->setFechaModificacion(new \DateTime());
                $em->persist($proveedor);
                $em->flush();
                return $this->render('proveedores/resultform.html.twig', [
                    'title' => 'Creado',
                    'text' => 'Proveedor ' . $proveedor->getNombre() . " creado con éxito.",
                ]);
            }

            return $this->render('proveedores/formpage.html.twig', [
                'title' => 'Crear Proveedor',
                'proveedor_form' => $form->createView(),
            ]);
        } else {
            $proveedor = new Proveedor();
            $repo = $em->getRepository(Proveedor::class);
            $proveedor = $repo->find($id);
            $form = $this->createForm(ProveedorType::class, $proveedor);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $proveedor->setFechaModificacion(new \DateTime());
                $em->persist($proveedor);
                $em->flush();
                return $this->render('proveedores/resultform.html.twig', [
                    'title' => 'Actualizado',
                    'text' => 'Proveedor ' . $proveedor->getNombre() . ' actualizado con éxito',
                ]);
            }
            return $this->render('proveedores/formpage.html.twig', [
                'title' => 'Editar Proveedor',
                'proveedor_form' => $form->createView(),
            ]);
        }
    }
}