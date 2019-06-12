<?php

namespace App\Controller;

use App\Entity\Photos;
use App\Form\PhotoType;
use App\Service\PaginationService;
use App\Repository\PhotosRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
     * @Route("/photos/nouvelle", name="photos_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $photo = new Photos();

        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($photo);
            $manager->flush();

            $this->addFlash('success', "La compo a bien été publiée");

            return $this->redirectToRoute("photo_show", ['slug' => $photo->getSlug()]);
        }
        else
        {
            return $this->render('photos/new.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

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
