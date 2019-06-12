<?php

namespace App\Controller;

use App\Entity\Compos;
use App\Form\ComposFormType;
use App\Service\PaginationService;
use App\Repository\ComposRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComposController extends AbstractController
{
    /**
     * @Route("/compos/{page<\d+>?1}", name="compos")
     */
    public function index($page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Compos::class)
                   ->setPage($page);
        
        return $this->render('compos/index.html.twig', [
            'compos' => $pagination->getData(),
            'pages' => $pagination->getPages(),
            'page' => $page
        ]);
    }

    /**
     * form and treatment of datas from it
     * 
     * @Route("/compos/nouvelle", name="compos_create")
     *
     * @param ObjectManager $manager
     * @param Request $request
     * 
     * @return Response
     */
    public function create(ObjectManager $manager, Request $request)
    {
        $compo = new Compos();
        
        $form = $this->createForm(ComposFormType::class, $compo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($compo);
            $manager->flush();

            $this->addFlash('success', "La compo a bien été publiée");

            return $this->redirectToRoute("compos_show", ['slug' => $compo->getSlug()]);
        }
        else
        {
            return $this->render('compos/new.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * show one compo
     * 
     * @Route("/compos/{slug}", name="compos_show")
     *
     * @return Response
     */
    public function show(Compos $compo)
    {
        return $this->render("compos/show.html.twig", [
            'compo' => $compo
        ]);
    }
}
