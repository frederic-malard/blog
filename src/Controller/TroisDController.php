<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TroisDController extends AbstractController
{
    /**
     * @Route("/3D", name="trois_d")
     */
    public function index()
    {
        return $this->render('trois_d/index.html.twig', [
            'controller_name' => 'TroisDController',
        ]);
    }
}
