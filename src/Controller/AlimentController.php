<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AlimentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliment")
     */
    public function index(AlimentRepository $repository)
    {

    $aliments = $repository->findAll();

        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
        ]);
    }

    /**
     * @Route("/addAliment", name="addAliment")
     */
    public function addAliment(Request $request, EntityManagerInterface $em)
    {

        $aliment = new Aliment(); // on créé un objet vide qu'on va passer en paramètre lors de la création de l'objet formulaire

        $form = $this->createForm(AlimentType::class,$aliment); // on créé un objet formulaire avec le TYPE créé dans le fichier src/Form/AlimentType.php

            $form->handleRequest($request); // on donne la requete à notre objet formulaire afin qu'il incorpore les données a l'objet aliment

            if ($form->isSubmitted() && $form->isValid()) {     // on vérifie si le formulaire est soumis et valide                           
                
                $nom = $aliment->getNom(); // on récupère le nom de l'aliment
                $uploadImage = $form['image']->getData(); // on récupère l'image uploadé

                $mime = $uploadImage->getMimeType();// ON RECUPERE
                $tab = explode('/',$mime);//////////// L'EXTENSION
                $ext = '.'.end($tab);///////////////// DE L'IMAGE
                
                $uploadImage->move('images',$nom.$ext); // on déplace l'image dans le dossier images et on lui donne le nom de l'aliment et l'extension du fichier
                
                $image = 'images/'.$nom.$ext; // on défini le nom du chemin jusqu'a l'image
                $aliment->setImage($image); // puis on le donne à l'objet aliment

                $em->persist($aliment); // persist de l'objet aliment
                $em->flush(); // sauvegarde en base de données
    
                return $this->redirectToRoute('aliment'); // redirection vers la page de nom de route 'aliment'
            }
            


        return $this->render('aliment/addAliment.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
