<?php

namespace App\Controller;

use App\Form\ServiceType;
use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Repository\ServiceRepository;
use App\Repository\SpecialiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpecialiteController extends AbstractController
{
    /**
     * @Route("/specialite", name="specialite.specialite.affiche")
     */
    public function specialite(SpecialiteRepository $repos)
    {
        $specialite = $repos->findAll();
            return $this->render('specialite/index.html.twig', [
            'specialites' => $specialite,
        ]);
    }
 /**
     * @Route("/specialite/add", name="specialite.specialite.add")
     */
    public function ajoutspecialite(SpecialiteRepository $repos,Request $request)
    {   
       $specialite = new Specialite();

    $form = $this->createForm(SpecialiteType::class, $specialite);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
        $manager= $this->getDoctrine()->getManager();
        $manager->persist($specialite );
        $manager->flush();
        $specialite = $form->getData();
            return $this->redirectToRoute('specialite.specialite.affiche');
    }

            return $this->render('specialite/form.html.twig', [
                'form' => $form->createView(),
    ]);
    
        $specialite = $repos->findAll();
        return $this->render('specialite/index.html.twig', [
            'specialites' => $specialite ,
        ]);
    }
    
 /**
     * @Route("/specialite/edit/{id}", name="specialite.specialite.edit")
     */
    public function editspecialite( $id , Request $request,SpecialiteRepository $repos  )
    {
        $specialite  = $repos->find($id);
        $form = $this->createForm(SpecialiteType::class, $specialite );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
        
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($specialite );
            $manager->flush();
            $specialite  = $form->getData();
            return $this->redirectToRoute('specialite.specialite.affiche');
        }
    
        return $this->render('specialite/form.html.twig', [
            'form' => $form->createView()

        ]);
    
    }   

 
 /**
     * @Route("/specialite/delete/{id}", name="specialite.specialite.delete")
     */
    public function deletespecialite( $id ,SpecialiteRepository $repos  )
    {
        $specialite  = $repos->find($id);
       
            $manager= $this->getDoctrine()->getManager();
            $manager->remove ($specialite);
            $manager->flush();
            return $this->redirectToRoute('specialite.specialite.affiche');
        
    
    } 


}
