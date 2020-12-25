<?php

namespace App\Controller;

use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/membres", name="membre.liste")
     */
    public function show(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Membre::class);
        $membres= $repository->findAll();
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
