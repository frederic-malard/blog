<?php

namespace App\Controller;

use App\Entity\Dessin;
use App\Form\DrawingType;
use App\Entity\CategorieDessin;
use App\Service\PaginationService;
use App\Repository\DessinRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DrawingsController extends AbstractController
{
    /**
     * @Route("/dessins/{page<\d+>?1}", name="drawings_index")
     */
    public function index(DessinRepository $repository, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Dessin::class)
                   ->setPage($page);

        return $this->render('drawings/index.html.twig', [
            'drawings' => $pagination->getData(),
            'pages' => $pagination->getPages(),
            'page' => $page
        ]);
    }

    /**
     * form, and request treatment
     * 
     * @Route("/dessin/nouveau", name="drawing_new")
     *
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $drawing = new Dessin();

        $form = $this->createForm(DrawingType::class, $drawing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach($drawing->getCategorie() as $category)
            {
                $drawing->addCategorie($category);
                $category->addDessin($drawing);

                $manager->persist($category);
            }

            $manager->persist($drawing);
            $manager->flush();

            $this->addFlash('success', "Le dessin a bien été posté");

            return $this->redirectToRoute('drawing_show', ['slug' => $drawing->getSlug()]);
        }
        else
        {
            return $this->render("drawings/new.html.twig", [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/dessin/{slug}/edit", name="drawing_edit")
     */
    public function edit(Dessin $drawing, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(DrawingType::class, $drawing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach($drawing->getCategorie() as $category)
            {
                $drawing->addCategorie($category);
                $category->addDessin($drawing);

                $manager->persist($category);
            }

            $manager->persist($drawing);
            $manager->flush();

            $this->addFlash('success', "Le dessin a bien été modifié");

            return $this->redirectToRoute('drawing_show', ['slug' => $drawing->getSlug()]);
        }

        return $this->render(
            "drawings/edit.html.twig",
            [
                'form' =>$form->createView()
            ]
        );
    }

    /**
     * show a drawing
     * 
     * @Route("/dessin/{slug}", name="drawing_show")
     *
     * @return Response
     */
    public function show(Dessin $drawing)
    {
        return $this->render('drawings/show.html.twig', [
            'drawing' => $drawing
        ]);
    }

    /**
     * show a full resolution (zoomed) drawing
     * 
     * @Route("/dessin/zoom/{slug}", name="drawing_zoom")
     *
     * @return Response
     */
    public function zoom(Dessin $drawing)
    {
        return $this->render('drawings/zoom.html.twig', [
            'drawing' => $drawing,
            'hide' => 'yes'
        ]);
    }
}
