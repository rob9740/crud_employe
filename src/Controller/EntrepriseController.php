<?php

namespace App\Controller;

use App\Entity\Employe;
use PhpParser\Node\Name;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="app_entreprise")
     */
    public function index( Employerepository $repo): Response
    {
        $employe = $repo->findAll();

        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
            'employe' => $employe,
            
            
        ]);
    }
    /**
     * @Route("/entreprise/edit/{id}" name="app_edit")
     * @Route("/entreprise/ajoute" name="ajout")
     *
     * @param Request $globals
     * @param EntityManagerInterface $manager
     * @param Employe $employe
     * @return void
     */
    public function form(Request $globals, EntityManagerInterface $manager, Employe $employe)

    {
     if($employe == null){
        $employe = new Employe;
     }
     $form=$this->createForm(EmployeType::class, $employe);

     $form->handleRequest($globals);

     if($form->isSubmitted() && $form->isValid())
     {
        $manager->persist($employe);
        $manager->flush();
        return $this->redirectToRoute("app_entreprise");
     }

     return $this->renderForm('entreprise/form.html.twig', [
        'form' => $form,
        'edit' => $employe->getId() !== null
     ]) ;
    }

  
} 