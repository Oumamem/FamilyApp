<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Entity\Membre;
use App\Form\MembreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MemberController extends AbstractController
{
    /**
     * @Route("/new", name="membre_new", methods={"GET","POST"})
     */
    public function new(Request $request,  SluggerInterface $slugger): Response
    {
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('path')->getData();
            if($file){
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                // Move the file to the directory where brochures are stored

                try {
                    $file->move(
                        $this->getParameter('souvenirs_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    dd($e);
                }


                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $membre->setPath($newFilename);

            }
            $file1 = $form->get('pathcover')->getData();
            if($file1){
                $originalFilename = pathinfo($file1->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file1->guessExtension();
                // Move the file to the directory where brochures are stored

                try {
                    $file1->move(
                        $this->getParameter('souvenirs_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    dd($e);
                }


                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $membre->setPathcover($newFilename);

            }


            $membre->setFamille($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();

            return $this->redirectToRoute('membre.liste');
        }

        return $this->render('member/new.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/membres", name="membre.liste")
     */
    public function show(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Membre::class);
        $membres= $repository->findByFamily($this->getUser());


        return $this->render('member/members.html.twig', [
            'controller_name' => 'MemberController',
            'membres'=> $membres,
        ]);
    }
    /**
     * @Route("/profile", name="profile.info")
     */
    public function info(): Response
    {
        return $this->render('member/profile.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
}
