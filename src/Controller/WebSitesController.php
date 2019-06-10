<?php

namespace App\Controller;

use App\Entity\WebSite;
use App\Form\WebSiteType;
use App\Repository\WebSiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebSitesController extends AbstractController
{
    /**
     * @Route("/web/sites", name="web_sites")
     */
    public function index(WebSiteRepository $repository)
    {
        $webSites = $repository->findAll();

        return $this->render('web_sites/index.html.twig', [
            'websites' => $webSites
        ]);
    }

    /**
     * indicate a new website
     *
     * @Route("/sites/nouveau", name="web_sites_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $webSite = new WebSite();

        $form = $this->createForm(WebSiteType::class, $webSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($webSite);
            $manager->flush();

            return $this->redirectToRoute("web_sites_show", ['slug' => $webSite->getSlug()]);
        }
        else
        {
            return $this->render("web_sites/new.html.twig", [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * show a website informations
     *
     * @Route("/sites/{slug}", name="web_sites_show")
     */
    public function show(WebSite $website)
    {
        return $this->render("web_sites/show.html.twig", [
            'website' => $website
        ]);
    }
}
