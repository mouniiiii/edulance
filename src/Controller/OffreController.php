<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\OffreGestion\Offre;
use App\Form\OffreType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\OffreGestion\OffreRepository;
use App\Repository\UserGestion\GlobalUserRepository;

class OffreController extends AbstractController
{
    public function postOffre(Request $request): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
    
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            // Determine the type of offer
            $typeOffre = $offre->getTypeOffre();
    
            // Assign id_creator based on the type of offer
            if ($typeOffre === 'Offre de service') {
                // Fetch the current user (assuming it's authenticated)
                $currentUser = $this->getUser();
                $offre->setIdCreator($currentUser);
                
                // Add the current user to id_other_part
                $offre->addIdOtherPart($currentUser);
            } elseif ($typeOffre === 'Offre d\'emploi') {
                // Fetch the business entity based on your application's logic
                $businessEntity = $entityManager->getRepository(Business::class)->findOneBy([...]);
                $offre->setIdCreator($businessEntity);
                
                // Add the current user to id_other_part
                $currentUser = $this->getUser();
                $offre->addIdOtherPart($currentUser);
            }

            $entityManager->persist($offre);
            $entityManager->flush();
    
            // Redirect to a success page or do any other required action
            return $this->redirectToRoute('app_jobpost');
        }
    
        return $this->render('/gestion_offre/post.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'OffreController', // Assuming you need this variable for some reason
        ]);
    }

    

    
}



