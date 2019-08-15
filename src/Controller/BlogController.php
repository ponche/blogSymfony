<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article; 

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        return $this->render('blog/home.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/blog/home", name="blog_home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig'); 
    }

    /**
     * @Route("/blog/create", name="blog_create")
     */
    public function create()
    {
        return $this->render('blog/create.html.twig') ; 
    }

    /**
     * @Route("/blog/show/{id}", name="blog_show")
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class); 

        $article = $repo->find($id);  
        
        return $this->render('blog/show.html.twig', [
            'article' =>$article , 
        ]) ; 
    }
}   



