<?php
namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
