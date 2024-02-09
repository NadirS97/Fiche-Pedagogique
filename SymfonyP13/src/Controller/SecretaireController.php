<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\FichePedagogique;
use App\Repository\EtudiantRepository;
use App\Repository\FichePedagogiqueRepository;
use App\Repository\SecrRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/secr")
 */
class SecretaireController extends AbstractController
{
    /**
     * @Route("/fiches", name="secr_fiches",methods={"GET"})
     */
    public function index(FichePedagogiqueRepository $fichePedagogiqueRepository): Response
    {
        $fiches=$fichePedagogiqueRepository->findBy(['EtatFiche'=>'en cours','transmis'=>null,'deleted'=>0]);
        return $this->json($fiches, 200, [],array('groups' => array('secr:fiche','statut')));
    }
    /**
     * @Route("/fiches/valider", name="secr_valider_fiche",methods={"POST"})
     */
    public function valider(Request $request, SerializerInterface $serializer,FichePedagogiqueRepository $fichePedagogiqueRepository,SecrRepository $secrRepository): Response
    {
        
        $data=$request->getContent();
        $post = $serializer->deserialize($data,FichePedagogique::class,'json');
        if($post){
            $fiche=$fichePedagogiqueRepository->findOneBy(['id'=>$post->getId()]);
            $secretaire=$secrRepository->findOneBy(['id'=>$post->getSecretaire()->getId()]);
            if($fiche){

                $fiche->setTransmis(false)
                ->setEtatFiche("valide")
                ->setDateValidation(new \DateTime('now'))
                ->setSecretaire($secretaire);
                $this->getDoctrine()->getManager()->flush();

                return $this->json(['success'=>true,'message'=>'Fiche transmis avec succes'], 200, []);
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
    /**
     * @Route("/fiches/refuser", name="secr_refuser_fiche",methods={"POST"})
     */
    public function refuser(Request $request, SerializerInterface $serializer,FichePedagogiqueRepository $fichePedagogiqueRepository): Response
    {
        
        $data=$request->getContent();
        $post = $serializer->deserialize($data,FichePedagogique::class,'json');
        if($post){
            $fiche=$fichePedagogiqueRepository->findOneBy(['id'=>$post->getId()]);
            if($fiche){
                $fiche->setTransmis(false)
                ->setEtatFiche("non valide");
                $this->getDoctrine()->getManager()->flush();
                return $this->json(['success'=>true,'message'=>'Fiche bien refusé'], 200, []);
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
    /**
     * @Route("/fiches_valide/{id}", name="secr_fiches_valide",methods={"GET"})
     */
    public function fiches_V(FichePedagogiqueRepository $fichePedagogiqueRepository,$id,SecrRepository $secrRepository): Response
    {
        $secretaire=$secrRepository->findOneBy(['id'=>$id]);   
        $fiches=$fichePedagogiqueRepository->findBy(['EtatFiche'=>'valide','transmis'=>0,'Secretaire'=>$secretaire,'deleted'=>0]);
        return $this->json($fiches, 200, [],array('groups' => array('secr:fiche')));
    }
    /**
     * @Route("/fiches_transmetre/{id}", name="secr_fiches_transmetre",methods={"GET"})
     */
    public function fiches_T(FichePedagogiqueRepository $fichePedagogiqueRepository,$id): Response
    {
        $fiche=$fichePedagogiqueRepository->findOneBy(['id'=>$id]);
        if($fiche){
            $fiche->setTransmis(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->json(['success'=>true,'message'=>'Fiche transmis avec succes'], 200, []);
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }
    }
    /**
     * @Route("/fiches_tout_transmettre/{id}", name="secr_fiches_transmettre_tout",methods={"GET"})
     */
    public function fiches_TT(FichePedagogiqueRepository $fichePedagogiqueRepository,$id,SecrRepository $secrRepository): Response
    {
        $secretaire=$secrRepository->findOneBy(['id'=>$id]);   
        $fiches=$fichePedagogiqueRepository->findBy(['EtatFiche'=>'valide','transmis'=>0,'Secretaire'=>$secretaire,'deleted'=>0]);
        if($fiches){
            
            foreach($fiches as $fiche){
                $fiche->setTransmis(true);
                $this->getDoctrine()->getManager()->flush();
            }
            return $this->json(['success'=>true,'message'=>'Toutes les fiches ont été bien transmises'], 200, []);
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }
    }
    /**
     * @Route("/fiches/etu/sans", name="secr_fiches_etu_sans",methods={"GET"})
     */
    public function fiches_ESF(EtudiantRepository $etudiantRepository): Response
    {
        $etudiants = $etudiantRepository->findAll();
        $result=[];
        foreach($etudiants as $etudiant )
        {
            $fiches= $etudiant->getFichePedagogiques();
            $i=0;
            if($fiches){
                foreach($fiches as $fiche){
                    if($fiche->getDate()< new \DateTime('now'.'-1 year')){
                            $i++;
                    }else{
                        $i=0;
                    }

                }        
                if($i){
                    $result[]=$etudiant;
                }
            }else{
                $result[]=$etudiant;
            }

        }

        return $this->json($result, 200, [],array('groups' => array('profile','Parcours')));
        
    }
}
