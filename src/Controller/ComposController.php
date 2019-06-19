<?php

namespace App\Controller;

use App\Entity\Compos;
use App\Entity\CommentCompo;
use App\Form\ComposFormType;
use App\Form\CommentCompoType;
use App\Service\PaginationService;
use App\Repository\ComposRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @Route("/compos/nouvelle", name="compos_create")
     * @IsGranted("ROLE_ADMIN")
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
    public function show(Compos $compo, Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();
        $formview = null;

        if ($user != null)
        {
            $comment = new CommentCompo();
            
            $form = $this->createForm(CommentCompoType::class, $comment);
            $form->handleRequest($request);

            $formview = $form->createView();

            if ($form->isSubmitted() && $form->isValid())
            {
                $comment->setCompo($compo);
                $comment->setAuthor($user);

                $manager->persist($comment);
                $manager->flush();

                $this->addFlash('success', 'Le commentaire a bien été ajouté.');

                return $this->redirectToRoute('compos_show', ['slug' => $compo->getSlug()]);
            }
        }

        return $this->render("compos/show.html.twig", [
            'compo' => $compo,
            'form' => $formview
        ]);
    }
}
