<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.service.afficher")
     */
    public function affichageservice(ServiceRepository $repos)
    {
        $service=$repos->findAll();
        return $this->render('admin/index.html.twig', [
            'services' => $service,
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('admin/home.html.twig');
    }

    
    /**
     * @Route("/admin/add", name="admin.service.add")
     */
    public function ajoutservice(ServiceRepository $repos,Request $request)
    {   
       $service = new Service();

    $form = $this->createForm(ServiceType::class, $service);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
        $manager= $this->getDoctrine()->getManager();
        $manager->persist($service);
        $manager->flush();
         $service = $form->getData();
         return $this->redirectToRoute('admin.service.afficher');
    }

    return $this->render('admin/form.html.twig', [
        'form' => $form->createView(),
    ]);
    
        $service = $repos->findAll();
        return $this->render('admin/index.html.twig', [
            'services' => $service,
        ]);
    }
    
 /**
     * @Route("/admin/edit/{id}", name="admin.service.edit")
     */
    public function editservice( $id ,Request $request,ServiceRepository $repos  )
    {
        $service = $repos->find($id);
        // ...

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
        
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($service);
            $manager->flush();
            $service = $form->getData();
            return $this->redirectToRoute('admin.service.afficher');
        }
    
        return $this->render('admin/form.html.twig', [
            'form' => $form->createView(),            
            'services' => $service,

        ]);
    
        return $this->render('admin/index.html.twig', [
                'services' => $service,
            ]);
    }   

 
 /**
     * @Route("/admin/delete/{id}", name="admin.service.delete")
     */
    public function deleteservice( $id ,ServiceRepository $repos  )
    {
        $service = $repos->find($id);
       
            $manager= $this->getDoctrine()->getManager();
            $manager->remove($service);
            $manager->flush();
            return $this->redirectToRoute('admin.service.afficher');
        
    
    }       
}      


