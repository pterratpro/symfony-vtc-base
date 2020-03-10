<?php

namespace App\Controller;

use App\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    /**
     * @Route("/vehicule", name="vehicule")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);
        $vehicules = $repository -> findAll();
        return $this->render('vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicules'=>$vehicules
        ]);
    }
}
