<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    
    public function index(Request $request): Response
    {
        $upload = new Upload();
        $form= $this->createForm(UploadType::class,$upload);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file=$upload->getName();
            $extension= $file->guessExtension('text/csv');
            $fileName=$file->getClientOriginalName().'.'.$extension;
            $file->move($this->getParameter('upload_directory'),$fileName);
            $upload->setName($fileName);  
            return $this->redirectToRoute('home');
            
            

        }
        return $this->render('home/home.html.twig', array(
            'form'=>$form->createView()
        ));
    }

}
