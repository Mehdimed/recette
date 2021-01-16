<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $aliment = new Aliment();

        $form = $this->createFormBuilder($aliment)
            ->add('nom', TextType::class)
            ->add('prix', IntegerType::class)
            ->add('calories', IntegerType::class)
            ->add('proteines', IntegerType::class)
            ->add('glucides', IntegerType::class)
            ->add('lipides', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter un Aliment'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                
    
                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                // $entityManager = $this->getDoctrine()->getManager();
                $nom = $aliment->getNom();
                $image = 'images/'.$nom.'.jpg';
                $aliment->setImage($image);
                dump($aliment);

                $em->persist($aliment);
                $em->flush();
    
                return $this->redirectToRoute('aliment');
            }
            


        return $this->render('aliment/addAliment.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
