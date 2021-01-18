<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AlimentType;
use App\Form\FiltreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliment")
     */
    public function index(AlimentRepository $repository,Request $request)
    {


        $form = $this->createForm(FiltreType::class);  //On créer un formulaire à partir du fichier Form/FiltreType.php
        $form->handleRequest($request);  // On donne la requête à notre formulaire, celui ci récupère les données si il y en a

        if($form->isSubmitted()){ // si la requete contenait les données du formulaire et a été soumis
            $data = $form->getData();// on récupére les données du formulaire
            $aliments = $repository->findByFiltre($data);// on récupère les aliments filtrés en fonction des données
        }else{
            $aliments = $repository->findAll();// sinon on récupère tous les aliments
        }

        // on donne les aliments et le formulaire à la vue
        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
            'formulaire' => $form->createView()
        ]);
    }

}
