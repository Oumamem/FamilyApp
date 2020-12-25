<?php

namespace App\Controller;

use App\Entity\Achat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchatsController extends AbstractController
{
    /**
     * @Route("/achats", name="achats")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Achat::class);
        $achats= $repository->findAll();
        $lastupdate=$repository->lastUpdate();
        return $this->render('achats/achats.html.twig', [
            'controller_name' => 'AchatsController',
            'achats' => $achats,
            'last'=>$lastupdate,
        ]);
    }
}
