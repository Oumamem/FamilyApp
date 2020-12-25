<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ToDoController extends AbstractController
{
    /**
     * @Route("/todo", name="to_do")
     */
    public function index(): Response
    {   $repository = $this->getDoctrine()->getRepository(Todo::class);
        $taches= $repository->findByDate();
        return $this->render('to_do/todolist.html.twig', [
            'controller_name' => 'todo',
            'taches' => $taches,
        ]);
    }
    /**
     * @Route("/todo/edit/{id?0}", name="todo.edit", methods="GET|POST")
     */
    public function edit(Todo $tache=null, Request $request):Response
    {
        if(!$tache)
            $tache= new Todo();

        $form=$this->createForm(TodoType::class,$tache);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Tache modifiée avec succes');

            return $this->redirectToRoute('to_do');

        } else {

            return $this->render('to_do/edit.html.twig', [

                'form'=>$form->createView(),
            ]);

        }
    }
    /**
     * @Route("/todo/{id}" ,name="todo.done")
     * @param Request $request
     * @return Response
     */
    public function termine(Todo $tache, Request $request):Response
    {
        $doctrine = $this->getDoctrine();
        // Nous permet de récupérer le manager
        $manager = $doctrine->getManager();

        $tache->setTermine(true);
        $manager->persist($tache);
        $manager->flush();
        return $this->redirectToRoute('to_do');
    }

    /**
     * @Route("/todo/create", name="todo.create", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $tache= new Todo();
        $form=$this->createForm(TodoType::class,$tache);

        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Propriété a été ajouté avec succès');
            return $this->redirectToRoute('to_do');
        }

        return $this->render('to_do/new.html.twig',[
            'tache'=>$tache,
            'form'=>$form->createView(),
        ]);

    }

}

