<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $pin =  new Pin();
        $form = $this->createForm(PinType::class, $pin);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute("app_pins_home");
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

    /**
     * @Route("/pins/{id<[0-9]+>}/edit", name="app_pins_edit", methods={"GET","PUT"})
     */
    public function edit(Pin $pin, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PinType::class, $pin, ['method' => 'PUT']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute("app_pins_home");
        }

        return $this->render('pins/edit.html.twig', ["form" => $form->createView(), "pin" => $pin]);
    }

    /**
     * @Route("/pins/delete/{id<[0-9]+>}", name="app_pins_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pin $pin, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete_pin' . $pin->getId(), $request->request->get('_csrf_token'))) {
            $em->remove($pin);
            $em->flush();
        }
        return $this->redirectToRoute('app_pins_home');
    }
}
