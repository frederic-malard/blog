<?php

namespace App\Controller;

use App\Entity\Photos;
use App\Service\PaginationService;
use App\Repository\PhotosRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhotosController extends AbstractController
{
    /**
     * @Route("/photos/{page<\d+>?1}", name="photos")
     */
    public function index($page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Photos::class)
                   ->setPage($page);

        return $this->render('photos/index.html.twig', [
            'photos' => $pagination->getData(),
            'pages' => $pagination->getPages(),
            'page' => $page
        ]);
    }

    /**
     * @Route("/textes/nouveau", name="textes_create")
     */
    /*public function create(Request $request, ObjectManager $manager)
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
    }*/

    /**
     * @Route("/photos/{slug}", name="photo_show")
     */
    public function show(Photos $photo)
    {
        return $this->render("photos/show.html.twig", [
            'photo' => $photo
        ]);
    }
}
