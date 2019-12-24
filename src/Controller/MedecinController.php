<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\genererMat\MatriculeGenerator;

class MedecinController extends AbstractController
{
    /**
     * @Route("/medecin", name="medecin.medecin.affiche")
     */
    public function medecin(MedecinRepository $repos)
    {   
        $medecin=$repos->findAll();
        return $this->render('medecin/index.html.twig', [
            'medecins' => $medecin,
        ]);

        $medecin ->getDatenaissence();
    }

 /**
     * @Route("/medecin/add", name="medecin.medecin.add")
     */
    public function ajoutmedecin(MedecinRepository $repos,Request $request,MatriculeGenerator $mat_generator)
    {   
       $medecin = new Medecin();
       $form = $this->createForm(MedecinType::class, $medecin); 
       $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
        $manager= $this->getDoctrine()->getManager();
        dump($mat_generator);
        $matricule = $mat_generator->generate($medecin);
        $medecin->setMatricule($matricule);
    
        $manager->persist($medecin );
        $manager->flush();
        $medecin = $form->getData();
         return $this->redirectToRoute('medecin.medecin.affiche');
    }

         return $this->render('medecin/form.html.twig', [
        'form' => $form->createView(),
        'medecins'=>$repos ->findAll(),
    ]);
    
        $medecin = $repos->findAll();
         return $this->render('medecin/index.html.twig', [
            'medecins' => $medecin,
        ]);
    }
    
 /**
     * @Route("/medecin/edit/{id}", name="medecin.medecin.edit")
     */
    public function editspecialite( $id , Request $request,MedecinRepository $repos  )
    {
        $medecin  = $repos->find($id);
        $form = $this->createForm(MedecinType::class, $medecin );
        $form->handleRequest($request);
        
    if ($form->isSubmitted() && $form->isValid())
        {
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($medecin);
            $manager->flush();
            return $this->redirectToRoute('medecin.medecin.affiche');
        }
    
            return $this->render('medecin/form.html.twig', [
                'form' => $form->createView()

        ]);
    
    }   

 
 /**
     * @Route("/medecin/delete/{id}", name="medecin.medecin.delete")
     */
    public function deletemedecin( $id ,MedecinRepository $repos  )
    {
        $medecin  = $repos->find($id);
        $manager= $this->getDoctrine()->getManager();
        $manager->remove ($medecin);
        $manager->flush();
            return $this->redirectToRoute('medecin.medecin.affiche');
        
    
    } 



}
