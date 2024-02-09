<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use App\Repository\FichePedagogiqueRepository;
use App\Repository\UeParcoursRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/ens", name="ens")
     */
class EnsController extends AbstractController
{
     
     /**
     * @Route("/fiches/etu/sans", name="ens_fiches_etu_sans",methods={"GET"})
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
    /**
     * @Route("/fiches_transmises", name="ens_fiches_valide",methods={"GET"})
     */
    public function fiches_V(FichePedagogiqueRepository $fichePedagogiqueRepository): Response
    {  
        $fiches=$fichePedagogiqueRepository->findBy(['EtatFiche'=>'valide','transmis'=>1,'deleted'=>0,'Confirmation'=>null]);
        return $this->json($fiches, 200, [],array('groups' => array('ens:fiche','statut','Ue')));
    }
    /**
     * @Route("/fiches_transmises/ue/valider/{id}", name="ens_fiches_ue_valide",methods={"GET"})
     */
    public function fiches_UV(UeParcoursRepository $ueParcoursRepository,$id): Response
    {  
        $ueparcour=$ueParcoursRepository->findOneBy(['id'=>$id]);
        if($ueparcour){

            $ueparcour->setValidationRSE('valide');
            $this->getDoctrine()->getManager()->flush();
            return $this->json(['message'=>'l\'etat RSE pour ce module est validé'], 200, []);
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }
    }
    /**
     * @Route("/fiches_transmises/ue/refuser/{id}", name="ens_fiches_ue_refuse",methods={"GET"})
     */
    public function fiches_UR(UeParcoursRepository $ueParcoursRepository,$id): Response
    {  
        $ueparcour=$ueParcoursRepository->findOneBy(['id'=>$id]);
        if($ueparcour){
            $ueparcour->setValidationRSE('refuse');
            $this->getDoctrine()->getManager()->flush();
            return $this->json(['message'=>'l\'etat RSE pour ce module est refusé'], 200, []);
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }
    }
    /**
     * @Route("/fiches_confirme/{id}", name="ens_fiches_confirme",methods={"GET"})
     */
    public function fiches_C(FichePedagogiqueRepository $fichePedagogiqueRepository,$id): Response
    {  
        $fiche=$fichePedagogiqueRepository->findOneBy(['id'=>$id]);

        if($fiche){
            $fiche->setConfirmation(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->json(['message'=>'fiche confirmée'], 200, []);
        }else{
            return $this->json([
                'status' => 400,
                'message' => "Oups!...une erreur est survenue reessayez plus tard!"
            ],400,[]);
        }
    }
     /**
     * @Route("/fiches_confirme", name="ens_fiches_confirme_liste",methods={"GET"})
     */
    public function fiches_Cn(FichePedagogiqueRepository $fichePedagogiqueRepository): Response
    {  
        $fiches=$fichePedagogiqueRepository->findBy(['EtatFiche'=>'valide','transmis'=>1,'deleted'=>0,'Confirmation'=>1]);
        return $this->json($fiches, 200, [],array('groups' => array('ens:fiche','statut','ue:info')));
    }
}
