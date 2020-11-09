<?php

namespace App\Controller;

use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/pins", name="App_pins_home")
     */
    public function index(PinRepository $pins): Response
    {
        $pins = $pins->findAll();
        return $this->render('pins/index.html.twig', compact('pins'));
    }

    /**
     * @Route("/pins/show", name="pins")
     */
    public function show(PinRepository $pins): Response
    {
        $pins = $pins->findAll();
        return $this->render('pins/index.html.twig', compact('pins'));
    }
}
