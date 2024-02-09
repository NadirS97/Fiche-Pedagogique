<?php

namespace App\Controller;
use Lexik\Bundle\JWTAuthenticationBundle\DependencyInjection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ConnexionController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
    
        $this->session = $session;
        $this->session->start();
    }
    /**
     * @Route("/login", name="connexion", methods={"GET"})
     */
    public function login(UserRepository $userRepository)
    {
        $display = $userRepository->findAll();
        dd($display);
    } 
    /**
     * @Route("/login", name="connexion_post", methods={"POST"})
     */
    public function login_post(Request $request, SerializerInterface $serializer, UserRepository $userRepository,  UserPasswordEncoderInterface $userPasswordEncoder, SessionInterface $session)
    {
        $data=$request->getContent();
        $session->clear();
        try{
            
            
                $post = $serializer->deserialize($data,User::class,'json');
                $result=$userRepository->findOneBy([
                    'Email' => $post->getEmail()
                ]);
                if($result){
                    if ($userPasswordEncoder->isPasswordValid($result,$post->getPassword())) { 

                            $variable=$result->getRoles();
                            $session->set('User',$variable);
                            switch ($variable) {
                                case 'Etudiant':
                                   // $json= $serializer->serialize($result,'json',['groupe'=>'User','Etu']);  
                                    return $this->json(['result'=>$result->getEtudiant(),'roles'=>$variable,'success'=>true],200,[],array('groups' => array('User','NumEtu')));
                                    break;
                                case 'Administratif':
                                    return $this->json(['result'=>$result->getSecr(),'roles'=>$variable,'success'=>true],200,[],array('groups' => array('User','Secr')));
                                    break;
                                case 'Enseignant':
                                    return $this->json(['result'=>$result,'roles'=>$variable,'success'=>true],200,[],array('groups' => array('User','Resp')));
                                    break;
                                
                                default:
                                
                                    return $this->json([
                                        'status' => 500,
                                        'message' => "Oups! Une erreur est survenue..."
                                    ],400,[]);
                                    break;
                            }
                        
                        $this->__construct($session);
                    // $this->session->set('Code',$result->getPassword());
                    
                        
                    }
                    else{
                        return $this->json([
                            'status' => 400,
                            'message' => "Mot de passe incorrect !"
                        ],400,[]);
                    }
                }
                else{
                    return $this->json([
                        'status' => 400,
                        'message' => "Utilisateur non trouvé"
                    ],400,[]);

                }
            
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ],400);
        }
        
    }
     /**
     * @Route(name="api_login", path="/api/login")
     * @return JsonResponse
     */
    public function api_login(Request $request,SerializerInterface $serializer, UserRepository $userRepository): JsonResponse
    {   
        /*$data=$request->getContent();
        $post = $serializer->deserialize($data,User::class,'json');
        $result=$userRepository->findOneBy([
            'Email' => $post->getEmail()
        ]);*/
        $user = $this->getUser();

        return new JsonResponse([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }
     /**
     * @Route("/logout", name="deconnexion")
     */
    public function logout()
    {
     
            $this->session->remove('User');
            return $this->json(['success'=>true,$this->session->has('User')],200,[]);
        
    }
}
