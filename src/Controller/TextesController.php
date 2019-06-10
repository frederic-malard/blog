<?php

namespace App\Controller;

use App\Entity\Texte;
use App\Form\TexteType;
use App\Repository\TexteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TextesController extends AbstractController
{
    /**
     * @Route("/textes", name="textes")
     */
    public function index(TexteRepository $repository)
    {
        $textes = $repository->findAll();

        return $this->render('textes/index.html.twig', [
            'textes' => $textes
        ]);
    }

    /**
     * @Route("/textes/nouveau", name="textes_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $texte = new Texte();

        $form = $this->createForm(TexteType::class, $texte);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($texte);
            $manager->flush();

            return $this->redirectToRoute("textes_show", ['slug' => $texte->getSlug()]);
        }
        else
        {
            return $this->render('textes/new.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/textes/{slug}", name="textes_show")
     */
    public function show(Texte $texte)
    {
        return $this->render("textes/show.html.twig", [
            'texte' => $texte
        ]);
    }
}
