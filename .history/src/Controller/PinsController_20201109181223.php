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
        $pins = $pins->findAll();
        return $this->render('pins/index.html.twig', compact('pins'));
    }

    /**
     * @Route("/pins/show", name="app_pins_show")
     */
    public function show(Pin $pins): Response
    {
        return $this->render('pins/show.html.twig', compact('pins'));
    }
}
