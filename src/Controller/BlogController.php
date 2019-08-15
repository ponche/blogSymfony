<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use Doctrine\Common\Persistence\ObjectManager; 

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Article; 
use App\Form\ArticleType;

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
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        return $this->render('blog/home.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/create", name="blog_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        dump($request); 
        $article = new Article() ; 

        // 1eme méthode pour crée un formulaire
        // $form = $this->createFormBuilder($article)
        //             ->add('title')
        //             ->add('content')
        //             ->add('image')
        //             ->add('save', SubmitType::class, [
        //                 'label' => 'Enregister', 
        //             ])
        //             ->getForm();

        // 2eme méthode beaucoup plus rapide 
        $form = $this->createForm(ArticleType::class, $article);

        // analyse la requete 
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid() )
        {

            $article->setCreatedAt(new \DateTime());

            $manager->persist($article);

            $manager->flush();
        }
        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]) ; 
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



