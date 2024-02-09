<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\FichePedagogique;
use App\Entity\Parcours;
use App\Entity\Statut;
use App\Entity\Ue;
use App\Entity\UeParcours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Secr;
use App\Entity\Respo;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker= \Faker\Factory::create('fr_FR');

        for ($j=0;$j<4; $j++){
            $secretaire=new Secr();
            $secretaire->setNom($faker->lastName)
                ->setPrenom($faker->firstName);
            $manager-> persist($secretaire);

            $user= new User();
            $user->setUsername($secretaire->getNom().join(array(".",$secretaire->getPrenom())))
                ->setPassword($this->encoder->encodePassword($user,$secretaire->getNom()))
                ->setEmail($secretaire->getNom().join(array(".",$secretaire->getPrenom(),"@univ-orleans.fr")))
                ->setRole('Administratif')
                ->setSecr($secretaire);

            $manager->persist($user);

            $responsable=new Respo();
            $responsable->setNom($faker->lastName)
                ->setPrenom($faker->firstName);
            $manager-> persist($responsable);

            $user= new User();
            $user->setUsername($responsable->getNom().join(array(".",$responsable->getPrenom())))
                ->setPassword($this->encoder->encodePassword($user,$responsable->getNom()))
                ->setEmail($responsable->getNom().join(array(".", $responsable->getPrenom(), "@univ-orleans.fr")))
                ->setRole('Enseignant')
                ->setRespo($responsable);

            $manager->persist($user);
        }
        $secretaire=new Secr();
            $secretaire->setNom($faker->lastName)
                ->setPrenom($faker->firstName);
            $manager-> persist($secretaire);

            $user= new User();
            $user->setUsername($secretaire->getNom().join(array(".",$secretaire->getPrenom())))
                ->setPassword($this->encoder->encodePassword($user,$secretaire->getNom()))
                ->setEmail($secretaire->getNom().join(array(".",$secretaire->getPrenom(),"@univ-orleans.fr")))
                ->setRole('Administratif')
                ->setSecr($secretaire);

            $manager->persist($user);

            $responsable=new Respo();
            $responsable->setNom($faker->lastName)
                ->setPrenom($faker->firstName);
            $manager-> persist($responsable);

            $user= new User();
            $user->setUsername($responsable->getNom().join(array(".",$responsable->getPrenom())))
                ->setPassword($this->encoder->encodePassword($user,$responsable->getNom()))
                ->setEmail($responsable->getNom().join(array(".", $responsable->getPrenom(), "@univ-orleans.fr")))
                ->setRole('Enseignant')
                ->setRespo($responsable);

            $manager->persist($user);
        for ($j=0;$j<25; $j++){
            $etudiant = new Etudiant();
            $etudiant->setNomEtudiant($faker->lastName)
                ->setPrenomEtudiant($faker->firstName)
                ->setAdresseEtudiant($faker->address)
                ->setAdresseParents($faker->address)
                ->setDateNaissance($faker->dateTimeBetween('-30 years','-18 years'))
                ->setTelEtudiant($faker->phoneNumber)
                ->setEmailEtudiant($etudiant->getNomEtudiant().join(array(".",$etudiant->getPrenomEtudiant(),"@etu.univ-orleans.fr")))
                ->setNumEtudiant($faker -> randomNumber(7));
            $manager-> persist($etudiant);

            $user= new User();
            $user->setUsername($etudiant->getNomEtudiant().join(array(".",$etudiant->getPrenomEtudiant())))
                ->setPassword($this->encoder->encodePassword($user,$etudiant->getNomEtudiant()))
                ->setEmail($etudiant->getEmailEtudiant())
                ->setRole('Etudiant')
                ->setEtudiant($etudiant);
            $manager->persist($user);

            $statut= new Statut();
            $rse=$faker->randomElement(array('oui', 'non'));
            $statut->setEtudiantRSE($rse)
                ->setEtudiantAJAC($faker->randomElement(array('oui', 'non')))
                ->setEtudiantREDOUBLANT($faker->randomElement(array('oui', 'non')))
                ->setEtudiantTiersTemps($faker->randomElement(array('oui', 'non')))
                ->setEtudiantSemestreObtenu('S'.join(array($faker->randomNumber(1))) )
                ->setEtudiant($etudiant);
            if($rse=='oui'){
                $statut->setEtudiantRNE('non');
            }else{
                $statut->setEtudiantRNE('oui');
            }

            $manager->persist($statut);


            $statut2= new Statut();
            $rse=$faker->randomElement(array('oui', 'non'));
            $statut2->setEtudiantRSE($rse)
                ->setEtudiantAJAC($faker->randomElement(array('oui', 'non')))
                ->setEtudiantREDOUBLANT($faker->randomElement(array('oui', 'non')))
                ->setEtudiantTiersTemps($faker->randomElement(array('oui', 'non')))
                ->setEtudiantSemestreObtenu('S'.join(array($faker->randomNumber(1))) )
                ->setEtudiant($etudiant);
            if($rse=='oui'){
                $statut2->setEtudiantRNE('non');
            }else{
                $statut2->setEtudiantRNE('oui');
            }

            $manager->persist($statut2);

            
            
            $parcours = new Parcours();
            $parcours->setLibelle($faker->word)
            ->setMention($faker->word)
            ->setNiveauParcours($faker->randomElement(array("L1","L2", "L3","M1","M2")));

            $fichePedagogique= new FichePedagogique();
            $fichePedagogique->setSemestre('S'.join(array($faker->randomNumber(1))))
                ->setEtatFiche($faker->randomElement(array("en cours","valide", "non valide")))
                ->setDate($faker->dateTime("now"))
                ->setDateValidation($faker->dateTime("now"))
                ->setSecretaire($secretaire)
                ->setEtudiant($etudiant)
                ->setStatut($statut)
                ->setDeleted(false);
                

            for($u=0;$u<2;$u++){
                $ue= new Ue();
                $ue->setECTS($faker->numberBetween(0,6))
                ->setCodeApogee("SLA".join(array($faker->randomNumber(2))))
                ->setLibelle($faker->word)
                ->setSemestre('S'.join(array($faker->randomDigitNotNull)))
                ->setType($faker->randomElement(array('OBLG', 'OPT')));
                $manager->persist($ue);

                $ueParcours = new UeParcours();
                $ueParcours->setAnneeParcours($faker->year('now'))
                ->setRSE($faker->randomElement(array('oui', 'non')))
                ->setInscription($faker->randomElement(array('oui', 'non')))
                ->setVNote($faker->randomFloat(2,0,20))
                ->setValidationRSE($faker->randomElement(array('valide', 'refuse')))
                ->setUe($ue);
                $manager->persist($ueParcours);

                $parcours->addUe($ue);

                $fichePedagogique->addUeParcour($ueParcours);
                
            }
            $manager->persist($fichePedagogique);
            $manager -> persist($parcours);

            $parcours = new Parcours();
            $parcours->setLibelle($faker->word)
            ->setMention($faker->word)
            ->setNiveauParcours($faker->randomElement(array("L1","L2", "L3","M1","M2")));

            $fichePedagogique= new FichePedagogique();
            $fichePedagogique->setSemestre('S'.join(array($faker->randomDigitNotNull)))
                ->setEtatFiche($faker->randomElement(array("en cours","valide", "non valide")))
                ->setDate($faker->dateTime("now"))
                ->setDateValidation($faker->dateTime("now"))
                ->setEtudiant($etudiant)
                ->setSecretaire($secretaire)
                ->setStatut($statut2)
                ->setDeleted(false);
                

            for($u=0;$u<2;$u++){
                $ue= new Ue();
                $ue->setECTS($faker->numberBetween(0,6))
                ->setSemestre('S'.join(array($faker->randomDigitNotNull)))
                ->setCodeApogee("SLA".join(array($faker->randomNumber(2))))
                ->setLibelle($faker->word)
                ->setType($faker->randomElement(array('OBLG', 'OPT')));
                $manager->persist($ue);

                $ueParcours = new UeParcours();
                $ueParcours->setAnneeParcours($faker->year('now'))
                ->setRSE($faker->randomElement(array('oui', 'non')))
                ->setInscription($faker->randomElement(array('oui', 'non')))
                ->setVNote($faker->randomFloat(2,0,20))
                ->setValidationRSE($faker->randomElement(array('valide', 'refuse')))
                ->setUe($ue);
                $manager->persist($ueParcours);

                $parcours->addUe($ue);

                $fichePedagogique->addUeParcour($ueParcours);  
                
            }
            $manager->persist($fichePedagogique);
            $manager -> persist($parcours);

            $etudiant = new Etudiant();
            $etudiant->setNomEtudiant($faker->lastName)
                ->setPrenomEtudiant($faker->firstName)
                ->setAdresseEtudiant($faker->address)
                ->setAdresseParents($faker->address)
                ->setDateNaissance($faker->dateTimeBetween('-30 years','-18 years'))
                ->setTelEtudiant($faker->phoneNumber)
                ->setEmailEtudiant($etudiant->getNomEtudiant().join(array(".",$etudiant->getPrenomEtudiant(),"@etu.univ-orleans.fr")))
                ->setNumEtudiant($faker -> randomNumber(7))
                ->setParcours($parcours);
            $manager-> persist($etudiant);

            $user= new User();
            $user->setUsername($etudiant->getNomEtudiant().join(array(".",$etudiant->getPrenomEtudiant())))
                ->setPassword($this->encoder->encodePassword($user,$etudiant->getNomEtudiant()))
                ->setEmail($etudiant->getEmailEtudiant())
                ->setRole('Etudiant')
                ->setEtudiant($etudiant);
            $manager->persist($user);
            
           
        }
          


        $manager->flush();
    }
}