<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConducteurController extends AbstractController
{
    /**
     * @Route("/conducteur", name="conducteur")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Conducteur::class);
        $conducteurs = $repository -> findAll();
        return $this->render('conducteur/index.html.twig', [
            'controller_name' => 'ConducteurController',
            'conducteurs'=>$conducteurs
        ]);
    }
        /**
        * @Route("/conducteur/{id}/edit", name="conducteur-edit")
     * @Route("/conducteur/new", name="conducteur-new")
     */
    public function new(Conducteur $conducteur = null,Request $request)
    {
        if(!$conducteur){
            $labelButton = "Créer un conducteur";
            $conducteur = new Conducteur();
        }

        $form = $this->createFormBuilder($conducteur)
                     ->add("prenom")
                     ->add("nom")
                    //  ->add("vehicule",EntityType::class, [
                    //     'class' => Vehicule::class,
                    //     'choice_label' => 'modele'
                    //  ])
                     ->add('save', SubmitType::class)
                     ->getForm();

        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($conducteur);
          $entityManager->flush();

          return $this->redirectToRoute('conducteur');
        }

        return $this->render('conducteur/new.html.twig', [
            'controller_name' => 'ConducteurController',
            'form'=>$form->createView()
        ]);
    }

        /**
     * @Route("/conducteur/{id}/delete", name="conducteur-delete")
     */
    public function delete(Request $request, Conducteur $conducteur)
    {
        //Supprimer en base de données par le biais du manager
        $em = $this->getDoctrine()->getManager();
        $em->remove($conducteur);
        $em->flush();
        return $this->redirectToRoute('conducteur');
    }
}
