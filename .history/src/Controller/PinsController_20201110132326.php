<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/pins", name="app_pins_home", methods={"GET"})
     */
    public function index(PinRepository $pins): Response
    {
        $pins = $pins->findBy([], ['createAt' => 'ASC']);
        return $this->render('pins/index.html.twig', compact('pins'));
    }


    /**
     * @Route("/pins/create", name="app_pins_create", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('Title', TextType::class)
            ->add('Description', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        return $this->render('pins/create.html.twig', ["form" => $form->createView()]);
    }

    /**
     * @Route("/pins/show/{id<[0-9]+>}", name="app_pins_show", methods={"GET"})
     */
    public function show(Pin $pin): Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }
}
