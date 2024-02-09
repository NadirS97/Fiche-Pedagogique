<?php

namespace App\Controller;

use App\Entity\Ue;
use App\Form\UeType;
use App\Repository\UeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/ue")
 */
class UeController extends AbstractController
{
    /**
     * @Route("/", name="ue_index", methods={"POST"})
     */
    public function index(UeRepository $ueRepository,Request $request,SerializerInterface $serializer)
    {
        $data=$request->getContent();
        $post = $this->get('serializer')->deserialize($data,Etudiant::class,'json');
       // $etudiant=$etudiantRepository->findOneBy(['NumEtudiant'=>$post->getNumEtudiant()]);
        //$resultat=$etudiant->getFichePedagogiques();
        //$etudiant=$etudiantRepository->findAll();
       // $etudiant=$etudiant->getParcours(); 
        return $this->json($data, 200, []);//, array('groups' => array('Parcours','Ue')));
    }

    /**
     * @Route("/new", name="ue_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ue = new Ue();
        $form = $this->createForm(UeType::class, $ue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ue);
            $entityManager->flush();

            return $this->redirectToRoute('ue_index');
        }

        return $this->render('ue/new.html.twig', [
            'ue' => $ue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ue_show", methods={"GET"})
     */
    public function show(Ue $ue): Response
    {
        return $this->render('ue/show.html.twig', [
            'ue' => $ue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ue $ue): Response
    {
        $form = $this->createForm(UeType::class, $ue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ue_index');
        }

        return $this->render('ue/edit.html.twig', [
            'ue' => $ue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ue_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ue $ue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ue_index');
    }
}
