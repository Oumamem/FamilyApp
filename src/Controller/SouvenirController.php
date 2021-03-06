<?php

namespace App\Controller;

use App\Entity\Souvenir;

use App\Form\SouvenirType;
use App\Repository\SouvenirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/souvenir")
 */
class SouvenirController extends AbstractController
{
    /**
     * @Route("/", name="souvenir_index", methods={"GET"})
     */
    public function index(SouvenirRepository $souvenirRepository): Response
    {
        return $this->render('souvenir/index.html.twig', [
            'souvenirs' => $souvenirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/tous", name="souv_all", methods={"GET"})
     */
    public function affiche(SouvenirRepository $souvenirRepository): Response
    {
        return $this->render('souvenir/photos.html.twig', [
            'souvenirs' => $souvenirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="souvenir_new", methods={"GET","POST"})
     */
    public function new(Request $request,  SluggerInterface $slugger): Response
    {
        $souvenir = new Souvenir();
        $form = $this->createForm(SouvenirType::class, $souvenir);
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
                $souvenir->setPath($newFilename);

            }
            $souvenir->setFamille($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($souvenir);
            $entityManager->flush();

            return $this->redirectToRoute('souvenir_index');
        }

        return $this->render('souvenir/new.html.twig', [
            'souvenir' => $souvenir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="souvenir_show", methods={"GET"})
     */
    public function show(Souvenir $souvenir): Response
    {
        return $this->render('souvenir/show.html.twig', [
            'souvenir' => $souvenir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="souvenir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Souvenir $souvenir): Response
    {
        $form = $this->createForm(SouvenirType::class, $souvenir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('souvenir_index');
        }

        return $this->render('souvenir/edit.html.twig', [
            'souvenir' => $souvenir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="souvenir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Souvenir $souvenir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$souvenir->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($souvenir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('souvenir_index');
    }
}
