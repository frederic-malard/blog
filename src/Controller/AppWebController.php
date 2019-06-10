<?php

namespace App\Controller;

use App\Entity\AppWeb;
use App\Form\AppWebType;
use App\Entity\CompetenceAppWeb;
use App\Repository\AppWebRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CompetenceAppWebRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppWebController extends AbstractController
{
    /**
     * @Route("/app-web", name="app_web")
     */
    public function index(AppWebRepository $repository)
    {
        $apps = $repository->findAll();

        return $this->render('app_web/index.html.twig', [
            'apps' => $apps
        ]);
    }

    /**
     * @Route("/app-web/nouvelle", name="app_web_create")
     */
    public function create(Request $request, ObjectManager $manager/*, CompetenceAppWebRepository $repository*/)
    {
        $app = new AppWeb();

        $form = $this->createForm(AppWebType::class, $app);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach ($app->getCompetences() as $competence)
            {
                $competence->addAppWeb($app);
                $manager->persist($competence);
            }

            $manager->persist($app);
            $manager->flush();

            return $this->redirectToRoute('app_web_launch', ['slug' => $app->getSlug()]);
        }
        else
        {
            //$competences = $repository->findAll();

            return $this->render('app_web/new.html.twig', [
                'form' => $form->createView()//,
                //'competences' => $competences
            ]);
        }
    }

    /**
     * launch the app, use the slug to find the url.
     *
     * @Route("/app-web/{slug}", name="app_web_launch")
     */
    public function launch(AppWeb $app)
    {
        return $this->render('app_web/show.html.twig', [
            'appweb' => $app
        ]);
    }
}
