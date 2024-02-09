<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Entity\Etudiant;
use App\Entity\UeParcours;
use Doctrine\DBAL\Exception;
use App\Entity\FichePedagogique;
use App\Repository\UeRepository;
use App\Form\FichePedagogiqueType;
use App\Repository\EtudiantRepository;
use App\Repository\FichePedagogiqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/etu")
 */
class FichePedagogiqueController extends AbstractController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/fiche", name="fiche_pedagogique_index", methods={"POST"})
     */
    public function index(SerializerInterface $serializer,Request $request,EtudiantRepository $etudiantRepository): Response
    {
        $data=$request->getContent();
        $post = $serializer->deserialize($data,Etudiant::class,'json');
        $etudiant=$etudiantRepository->findOneBy(['NumEtudiant'=>$post->getNumEtudiant()]);
        //$resultat=$etudiant->getFichePedagogiques();
        //$etudiant=$etudiantRepository->findAll();
        $fiches=$etudiant->getFichePedagogiques();
        $fiches_=[];
        foreach($fiches as $fiche){
            if(!$fiche->getDeleted())
                {
                    $fiches_[]=$fiche;
                }  
        }
        //dd($json);   
        return $this->json($fiches_, 200, [], array('groups' => array('NumEtu','Fiche','UeParcours','Parcours','Ue')));
    }

    /**
     * @Route("/ue", name="ue", methods={"POST"})
     */
    public function Ue(Request $request,SerializerInterface $serializer,EtudiantRepository $etudiantRepository): Response
    {
        $data=$request->getContent();
        $post = $serializer->deserialize($data,Etudiant::class,'json');
        $etudiant=$etudiantRepository->findOneBy(['NumEtudiant'=>$post->getNumEtudiant()]);
        //$resultat=$etudiant->getFichePedagogiques();
        //$etudiant=$etudiantRepository->findAll();
        $parcours=$etudiant->getParcours(); 
        if($parcours)
            return $this->json($parcours, 200, [], array('groups' => array('Parcour','Ues')));
        else
            return $this->json(['message'=>'Vous n\'etes inscrit dans aucun parcours '], 400, []);
    }

    /**
     * @Route("/fiche/new", name="fiche_pedagogique_new", methods={"GET","POST"})
     */
    public function new(Request $request, SerializerInterface $serializer,EtudiantRepository $etudiantRepository,UeRepository $ueRepository): Response
    {
        try{

            $fichePedagogique = new FichePedagogique();
            $statut = new Statut();
            $data=$request->getContent();
            $post = $serializer->deserialize($data,FichePedagogique::class,'json');
    
            $etudiant =$etudiantRepository->findOneBy(['NumEtudiant'=>$post->getEtudiant()->getNumEtudiant()]);
            
            $status=$post->getEtudiant()->getStatut();

            $statut->setEtudiantRSE($status[0]->getEtudiantRSE())
            ->setEtudiantAJAC($status[0]->getEtudiantAJAC())
            ->setEtudiantREDOUBLANT($status[0]->getEtudiantREDOUBLANT())
            ->setEtudiantTiersTemps($status[0]->getEtudiantTiersTemps())
            ->setEtudiantSemestreObtenu($status[0]->getEtudiantSemestreObtenu());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statut);

            $etudiant->addStatut($statut);
            

            $fichePedagogique->setSemestre('S2')
            ->setEtatFiche('En cours')
            ->setDate(new \DateTime)
            ->setStatut($statut)
            ->setEtudiant($etudiant);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fichePedagogique);
    
            $UeParcours_data=$post->getUeParcours();
    
            foreach( $UeParcours_data as $Parcours )
            {
                $ue=$ueRepository->findOneBy(['id'=>$Parcours->getUe()->getId()]);
                
                $UeParcours= new UeParcours();
                $UeParcours->setAnneeParcours(2020)
                ->setRSE($Parcours->getRSE())
                ->setValidationRSE(false)
                ->setInscription($Parcours->getInscription())
                ->setVNOte($Parcours->getVNote())
                ->setUe($ue)
                ->setFichePedagogique($fichePedagogique);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($UeParcours);
                $fichePedagogique->setSemestre($ue->getSemestre());
                
            }   
            $entityManager->flush();     
            $this->getDoctrine()->getManager()->flush();
            
            return $this->json(['success'=>true,'message'=>'Fiche pedagogique envoyee avec succes'], 200, []);
        }catch(Exception $e){
            return $this->json(['message'=>$e->getMessage()], 400, []);

        }

        

    }

    /**
     * @Route("/profile/{NumEtudiant}", name="profile", methods={"GET"})
     */
    public function profile(EtudiantRepository $etudiantRepository,$NumEtudiant): Response
    {
        $etudiant =$etudiantRepository->findOneBy(['NumEtudiant'=>$NumEtudiant]);
        if($etudiant){
            return $this->json($etudiant, 200, [], array('groups' => array('profile','Parcours')));
            
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }

        
    }
    /**
     * @Route("/profile/{NumEtudiant}", name="profile_update", methods={"POST"})
     */
    public function profile_update(Request $request, SerializerInterface $serializer,EtudiantRepository $etudiantRepository,$NumEtudiant): Response
    {
        $etudiant =$etudiantRepository->findOneBy(['NumEtudiant'=>$NumEtudiant]);
        if($etudiant){
            $data=$request->getContent();
            $post = $serializer->deserialize($data,Etudiant::class,'json');
            if($post){

                $etudiant->setAdresseEtudiant($post->getAdresseEtudiant())
                ->setDateNaissance($post->getDateNaissance())
                ->setNomEtudiant($post->getNomEtudiant())
                ->setPrenomEtudiant($post->getPrenomEtudiant())
                ->setTelEtudiant($post->getTelEtudiant());
                
                $this->getDoctrine()->getManager()->flush();
                
                return $this->json([
                    'status' => 200,
                    'message' => "Modification bien effectuée!"
                ],200,[]);
            }
            else{
                return $this->json([
                    'status' => 400,
                    'message' => "Oups!...une erreur est survenue reessayez plus tard!"
                ],400,[]);
            }
            
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }

        
    }

    /**
     * @Route("/password", name="modifier_passwoed", methods={"POST"})
     */
    public function password(Request $request, SerializerInterface $serializer,EtudiantRepository $etudiantRepository,UserPasswordEncoderInterface $userPasswordEncoder): Response
    {
        $data=$request->getContent();
        $post = $serializer->deserialize($data,Etudiant::class,'json');

        $etudiant =$etudiantRepository->findOneBy(['NumEtudiant'=>$post->getNumEtudiant()]);
        if($etudiant){
            $user=$etudiant->getUserAcc();

            if ($userPasswordEncoder->isPasswordValid($user,$post->getUserAcc()->getPassword())) { 

            $user->setPassword($this->encoder->encodePassword($user,$post->getNVPassword()));
            $this->getDoctrine()->getManager()->flush();
                return $this->json([
                    'status' => 200,
                    'message' => "Mise à jour du mot de passe avec succes !"
                ], 200, []); 
            }
            else{
                return $this->json([
                    'status' => 400,
                    'message' => "Mot de passe incorrect !"
                ],400,[]);
            }
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }

      
    }
     /**
     * @Route("/fiche/remove", name="fiche_delete", methods={"POST"})
     */
    public function delete(Request $request,FichePedagogiqueRepository $fichePedagogiqueRepository, SerializerInterface $serializer): Response
    {
            $data=$request->getContent();
            $post = $serializer->deserialize($data,FichePedagogique::class,'json');     
            if($post){
                $fiche=$fichePedagogiqueRepository->findOneBy(['id'=>$post->getId()]);
                if($fiche){
                   $fiche->setDeleted(true);
                   $this->getDoctrine()->getManager()->flush();
                    return $this->json(['success'=>true,'message'=>'fiche supprimer avec succee'], 200, []);
                }else{
                    return $this->json([
                        'status' => 400,
                        'message' => "Oups!...une erreur est survenue reessayez plus tard!"
                    ],400,[]);
                }
                
            }else{
                return $this->json([
                    'status' => 400,
                    'message' => "Oups!...une erreur est survenue reessayez plus tard!"
                ],400,[]);
            }

    }
}
