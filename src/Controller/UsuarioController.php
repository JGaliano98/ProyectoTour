<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;

class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $Usuario = new Usuario();
        $Usuario -> setNombre("Jesús");
        $Usuario -> setApellido1("López");
        $Usuario -> setApellido2("Galiano");
        $Usuario -> setCorreo("jlopgal0606@g.educaand.es");
        $Usuario -> setTelefono("620573098");
        $Usuario -> setContraseña("123456");
        $Usuario -> setRol("Administrador");

        $entityManager -> persist($Usuario);

        $entityManager -> flush();


        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
        ]);
    }
}