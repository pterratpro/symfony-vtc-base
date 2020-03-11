<?php

namespace App\Controller;

use App\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class VehiculeController extends AbstractController
{
    /**
     * @Route("/vehicule", name="vehicule")
     * @IsGranted("ROLE_ADMIN")
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
