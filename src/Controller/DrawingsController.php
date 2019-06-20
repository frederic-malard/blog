<?php

namespace App\Controller;

use App\Entity\Dessin;
use App\Entity\Comment;
use App\Form\DrawingType;
use App\Entity\CommentDrawing;
use App\Entity\CategorieDessin;
use App\Form\CommentDrawingType;
use App\Repository\UserRepository;
use App\Service\PaginationService;
use App\Repository\DessinRepository;
use App\Repository\CommentRepository;
use App\Repository\CommentDrawingRepository;
use App\Repository\CategorieDessinRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DrawingsController extends AbstractController
{
    /**
     * @Route("/dessin/{page<\d+>?1}", name="drawings_index")
     */
    public function index($page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Dessin::class)
                   ->setPage($page);

        return $this->render('drawings/index.html.twig', [
            'drawings' => $pagination->getData(),
            'pages' => $pagination->getPages(),
            'page' => $page
        ]);
    }
    /*[Composer\Downloader\TransportException]                                                          
    The "https://flex.symfony.com/versions.json" file could not be downloaded: failed to open stream  
    : Connection refused    */   

    /**
     * form, and request treatment
     * 
     * @Route("/dessin/nouveau", name="drawing_new")
     * @IsGranted("ROLE_ADMIN")
     *
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager, CategorieDessinRepository $repository)
    {
        $drawing = new Dessin();

        $form = $this->createForm(DrawingType::class, $drawing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $categories = $repository->findAll();
            $categoriesNames = [];

            foreach($categories as $category)
            {
                $categoriesNames[] = $category->getName();
            }

            foreach($drawing->getCategorie() as $category)
            {
                if (in_array($category->getName(), $categoriesNames))
                {
                    $name = $category->getName();
                    $drawing->removeCategorie($category);
                    $oldCategory = $repository->findOneBy(array('name' => $name));
                    $drawing->addCategorie($oldCategory);
                    $oldCategory->addDessin($drawing);

                    $manager->persist($oldCategory);
                }
                else
                {
                    $drawing->addCategorie($category);
                    $category->addDessin($drawing);
                    $category->setRepresentant($drawing);
    
                    $manager->persist($category);
                }
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
     * @IsGranted("ROLE_ADMIN")
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
                'form' => $form->createView()
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
    public function show(Dessin $drawing, Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();
        $formview = null;

        if ($user != null)
        {
            $comment = new CommentDrawing();
            
            $form = $this->createForm(CommentDrawingType::class, $comment);
            $form->handleRequest($request);

            $formview = $form->createView();

            if ($form->isSubmitted() && $form->isValid())
            {
                $comment->setDrawing($drawing);
                $comment->setAuthor($user);

                $manager->persist($comment);
                $manager->flush();

                $this->addFlash('success', 'Le commentaire a bien été ajouté.');

                return $this->redirectToRoute('drawing_show', ['slug' => $drawing->getSlug()]);
            }
        }

        return $this->render('drawings/show.html.twig', [
            'drawing' => $drawing,
            'form' => $formview
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
