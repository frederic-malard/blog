<?php

namespace App\Controller;

use App\Entity\Dessin;
use App\Form\DrawingType;
use App\Entity\CategorieDessin;
use App\Form\CategoryDrawingType;
use App\Repository\DessinRepository;
use App\Form\CategoryDrawingCompleteType;
use App\Repository\CategorieDessinRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DrawingsCategoriesController extends AbstractController
{
    /**
     * @Route("/dessins/categories", name="drawings_categories")
     */
    public function index(CategorieDessinRepository $repository)
    {
        $categories = $repository->findAll();
        return $this->render('drawingsCategories/index.html.twig', [
            'categories' => $categories
        ]);
    }
    
    /**
     * @Route("/dessins/categories/nouvelle", name="drawings_categories_new")
     */
    public function create(Request $request, ObjectManager $manager, DessinRepository $drawingRepository)
    {
        $category = new CategorieDessin();

        $form = $this->createForm(CategoryDrawingType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach($category->getDessin() as $drawing)
            {
                $drawing->addCategorie($category);
                $category->addDessin($drawing);

                $manager->persist($drawing);
            }

            $manager->persist($category);
            $manager->flush();

            $this->addFlash('success', "La catégorie a bien été enregistrée");

            return $this->redirectToRoute('drawing_show', ['slug' => $drawing->getSlug()]);
        }
        else
        {
            return $this->render("drawings/newCategory.html.twig", [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/dessins/categories/{slug}/edit", name="drawings_categories_edit")
     */
    public function edit(CategorieDessin $category, Request $request, ObjectManager $manager, DessinRepository $drawingRepository)
    {
        $form = $this->createForm(CategoryDrawingCompleteType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach($category->getDessin() as $drawing)
            {
                $drawing->addCategorie($category);
                $category->addDessin($drawing);

                $manager->persist($drawing);
            }

            $manager->persist($category);
            $manager->flush();

            $this->addFlash('success', "La catégorie de dessin a bien été modifié");

            return $this->redirectToRoute('drawings_categories_show', ['slug' => $category->getSlug()]);
        }

        $drawings = $drawingRepository->findAll();

        return $this->render(
            "drawingsCategories/edit.html.twig",
            [
                'form' =>$form->createView(),
                'drawings' => $drawings
            ]
        );
    }

    /**
     * show a category
     * 
     * @Route("/dessins/categories/{slug}", name="drawings_categories_show")
     *
     * @return Response
     */
    public function show(CategorieDessin $category)
    {
        return $this->render('drawingsCategories/show.html.twig', [
            'category' => $category
        ]);
    }
}