<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Famille;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




class FamilleController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $em , UserPasswordEncoderInterface $passwordEncoder ): Response
    {

        $famille = new Famille();
        $form = $this->createForm(RegistrationType::class, $famille);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $famille->setPassword(
                $passwordEncoder->encodePassword(
                    $famille,
                    $form->get('password')->getData()
                )
            );

            $em->persist($famille);
            $em->flush();
            return $this->redirectToRoute('app_login');

        }
        return $this->render('famille/Inscription.html.twig',
            ['form' =>$form->createView()]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/famille/edit/{id?0}", name="famille.edit", methods="GET|POST")
     */
    public function edit(Famille $famille=null, Request $request):Response
    {
        if(!$famille)
            $tache= new Famille();

        $form=$this->createForm(RegistrationType::class,$famille);
        $form->remove('password');

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Tache modifiée avec succes');

            return $this->redirectToRoute('home');

        } else {

            return $this->render('famille/profile.html.twig', [

                'form'=>$form->createView(),
            ]);

        }
    }



}
