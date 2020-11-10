<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/pins", name="app_pins_home")
     */
    public function index(PinRepository $pins): Response
    {
        $pins = $pins->findBy([], ['createAt' => 'ASC']);
        return $this->render('pins/index.html.twig', compact('pins'));
    }


    /**
     * @Route("/pins/create", name="app_pins_create")
     */
    public function create(Pin $pin): Response
    {
        $form = $this->createFormBuilder()
            ->add('Title')
            ->add('Description')
            ->getForm()->createView();

        return $this->render('pins/show.html.twig', compact('pin'));
    }

    /**
     * @Route("/pins/show/{id<[0-9]+>}", name="app_pins_show")
     */
    public function show(Pin $pin): Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }
}
