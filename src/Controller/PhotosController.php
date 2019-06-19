<?php

namespace App\Controller;

use App\Entity\Photos;
use App\Form\PhotoType;
use App\Entity\CommentPhoto;
use App\Form\CommentPhotoType;
use App\Service\PaginationService;
use App\Repository\PhotosRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN")
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
    public function show(Photos $photo, Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();
        $formview = null;

        if ($user != null)
        {
            $comment = new CommentPhoto();
            
            $form = $this->createForm(CommentPhotoType::class, $comment);
            $form->handleRequest($request);

            $formview = $form->createView();

            if ($form->isSubmitted() && $form->isValid())
            {
                $comment->setPhoto($photo);
                $comment->setAuthor($user);

                $manager->persist($comment);
                $manager->flush();

                $this->addFlash('success', 'Le commentaire a bien été ajouté.');

                return $this->redirectToRoute('photo_show', ['slug' => $photo->getSlug()]);
            }
        }

        return $this->render("photos/show.html.twig", [
            'photo' => $photo,
            'form' => $formview
        ]);
    }
}
