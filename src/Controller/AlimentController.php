<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('image', FileType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter un Aliment'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {                
    
                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                // $entityManager = $this->getDoctrine()->getManager();
                
                
                $nom = $aliment->getNom();
                $uploadImage = $form['image']->getData();
                dump($uploadImage);
                $mime = $uploadImage->getMimeType();
                dump($mime);
                $tab = explode('/',$mime);
                $ext = '.'.$tab[1];
                
                $uploadImage->move('images',$nom.$ext);
                
                $image = 'images/'.$nom.$ext; // <== ICI TU DOIS JUSTE GET LE NOM ET LE SET DANS L'IMAGE
                $aliment->setImage($image);

                $em->persist($aliment);
                $em->flush();
    
                return $this->redirectToRoute('aliment');
            }
            


        return $this->render('aliment/addAliment.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
