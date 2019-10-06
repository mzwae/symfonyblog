<?php
namespace App\Controller;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class PostController extends Controller{
  /**
   * @Route("/", name="article_list")
   * @Method({"GET"})
   */

  public function index(){
    // return new Response('<html><body>Hello</body></html>');
    // $posts = ['Post 1', 'Post 2'];

    $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

    return $this->render('posts/index.html.twig', array('posts' => $posts));
  }



   /**
    * @Route("/post/new", name:"new_post")
    * Method({"GET", "POST"})
    */
    public function new(Request $request){
      $post = new Post();

      $form = $this->createFormBuilder($post)
        ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $article = $form->getData();
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($article);
          $entityManager->flush();

          return $this->redirectToRoute('article_list');
        }
      return $this->render('posts/new.html.twig', array(
        'form' => $form->createView()
      ));

    }

    /**
     *
     * @Route("/post/{id}", name="post_show")
     */
     public function show($id){
       $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
       return $this->render('posts/show.html.twig', array('post' => $post));
     }

  // /**
  //  * @Route("/post/save")
  //  */
  //  public function save(){
  //    $entityManager = $this->getDoctrine()->getManager();
  //
  //    $post = new Post();
  //    $post->setTitle('Post Two');
  //    $post->setBody('This is the body for post two');
  //
  //    $entityManager->persist($post);
  //
  //    $entityManager->flush();
  //
  //    return new Response('Saved post with the id of ' . $post->getId());
  //  }


}
