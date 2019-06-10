<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {
    /**
     * @Route("/", name="homepage", requirements={"infoInutile" = "\d+"});
     */
    function home() {
        // calcul de mon age
        $ajourdhui = new \DateTime();
        $timestamp = $ajourdhui->getTimestamp();
        $anneeActuelle = idate("Y", $timestamp);
        $moisActuel = idate("m", $timestamp);
        $jourActuel = idate("d", $timestamp);
        $age = $anneeActuelle - 1992;
        if ($moisActuel > 3) {
            $age++;
        }
        elseif ($jourActuel >= 6) {
            $age++;
        }

        // mes études
        $etudes = [
            2009 => [
                        "domaine" => "physique",
						"organisme" => "la faculté des sciences",
						"lieu" => "montpellier",
						"diplome" => "licence",
						"arret" => 1
                    ],
            2010 => [
                        "domaine" => "informatique",
						"organisme" => "la faculté des sciences",
						"lieu" => "montpellier",
						"diplome" => "licence",
						"arret" => 1
                    ],
            2010 => [
                        "domaine" => "maths infos",
						"organisme" => "la faculté des sciences",
						"lieu" => "montpellier",
						"diplome" => "licence",
						"arret" => 1
                    ],
            2011 => [
                        "domaine" => "informatique",
						"organisme" => "la faculté des sciences",
						"lieu" => "montpellier",
						"diplome" => "licence",
						"arret" => 3
                    ],
            2015 => [
                        "domaine" => "cinéma d'animation 3D",
						"organisme" => "l'ESMA",
						"lieu" => "montpellier",
						"diplome" => "cycle Pro bac+5",
						"arret" => 1
                    ],
            2016 => [
                        "domaine" => "informatique, spécialité web développement",
                        "organisme" => "openclassrooms",
                        "lieu" => "internet",
						"diplome" => "équivalent licence",
						"arret" => "en cours"
                    ]
        ];
        $experience = [
            2013 => [
                        "activite" => "plonge",
                        "lieu" => "RU triolet montpellier"
                    ],
            2015 => [
                        "activite" => "site web pour entreprise réelle",
                        "lieu" => "faculté des sciences de montpellier"
                    ],
            2017 => [
                        "activite" => "site wordpress",
                        "lieu" => "openclassrooms"
                    ],
            2017 => [
                        "activite" => "gestion projet",
                        "lieu" => "openclassrooms"
                    ],
            2018 => [
                        "activite" => "site PHP MySQL JS",
                        "lieu" => "openclassrooms"
                    ],
        ];
        $categories = [
            "drawings_index" => "dessins",
            "compos" => "compositions musicales",
            "web_sites" => "sites web",
            "textes" => "écriture",
            "app_web" => "applications web",
            /*"3D" => "3D",
            "jeuxVideos" => "jeux-vidéos",
            "jeuxSociete" => "jeux de société",
            "sciences" => "vulgarisation scientifique"*/
        ];
        return $this->render(
            "home.html.twig",
            [
                "age" => $age,
                "etudes" => $etudes,
                "experience" => $experience,
                "categories" => $categories
            ]
        );
    }
}