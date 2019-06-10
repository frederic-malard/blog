<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Dessin;
use App\Entity\CategorieDessin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // dessins

        /*$ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);*/

        $adel = new Dessin();
        $adel->setUrl('/dessins/adel.jpg')
             ->setnom('adel')
             ->setCaption('portrait de modèle vivant au stylo')
             ->setDateCreation(new \DateTime('2013-01-01'))
             ->setDatePublication(new \DateTime());
        $manager->persist($adel);

        $anaellePhoto = new Dessin();
        $anaellePhoto->setUrl('/dessins/anaellePhoto.jpg')
            ->setnom('portrait miroir')
            ->setCaption('portrait via photo, selfie dans un miroir avec appareil photo réflèxe')
            ->setDateCreation(new \DateTime('2012-01-01'))
            ->setDatePublication(new \DateTime());
        $manager->persist($anaellePhoto);

        $bronson = new Dessin();
        $bronson->setUrl('/dessins/bronson.jpg')
            ->setnom('charles bronson')
            ->setCaption('Charles Bronson, dans "il était une fois dans l\'ouest", jouant de l\'harmonica')
            ->setDateCreation(new \DateTime('2012-01-01'))
            ->setDatePublication(new \DateTime());
        $manager->persist($bronson);

        /*$ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);

        $ = new Dessin();
        $->setUrl('/dessins/.jpg')
            ->setnom('')
            ->setCaption('')
            ->setDateCreation(new \DateTime(''))
            ->setDatePublication(new \DateTime());
        $manager->persist($);*/





        // catégories
        $portrait = new CategorieDessin();
        $portrait->setName('portrait')
                ->setRepresentant($adel)
                ->addDessin($adel)
                ->addDessin($anaellePhoto)
                ->addDessin($bronson);
        $manager->persist($portrait);
        /*$animal = new CategorieDessin();
        $animal->setName('animal');
        $paysage = new CategorieDessin();
        $paysage->setName('paysage');
        $imaginaire = new CategorieDessin();
        $imaginaire->setName('imaginaire');*/
        $celebrite = new CategorieDessin();
        $celebrite->setName('célébrité')
                ->setRepresentant($bronson)
                ->addDessin($bronson);
        $manager->persist($celebrite);
        /*$doom = new CategorieDessin();
        $doom->setName('doom');
        $slipknot = new CategorieDessin();
        $slipknot->setName('slipknot');
        $korn = new CategorieDessin();
        $korn->setName('korn');
        $metal = new CategorieDessin();
        $metal->setName('metal');
        $yeux = new CategorieDessin();
        $yeux->setName('yeux');
        $sombres = new CategorieDessin();
        $sombres->setName('sombres');
        $nature = new CategorieDessin();
        $nature->setName('nature');
        $mer = new CategorieDessin();
        $mer->setName('mer');
        $pasSombres = new CategorieDessin();
        $pasSombres->setName('pas sombres');*/
        $stylo = new CategorieDessin();
        $stylo->setName('stylo')
            ->setRepresentant($bronson)
            ->addDessin($adel)
            ->addDessin($anaellePhoto)
            ->addDessin($bronson);
        $manager->persist($stylo);
        /*$pastel = new CategorieDessin();
        $pastel->setName('pastel');*/
        $croquis = new CategorieDessin();
        $croquis->setName('croquis')
                ->setRepresentant($anaellePhoto)
                ->addDessin($adel)
                ->addDessin($anaellePhoto);
        $manager->persist($croquis);
        $detail = new CategorieDessin();
        $detail->setName('detaillé')
                ->setRepresentant($bronson)
                ->addDessin($bronson);
        $manager->persist($detail);




        $manager->flush();
    }
}
