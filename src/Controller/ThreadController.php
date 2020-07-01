<?php

namespace App\Controller;

use DateTime;
use App\Entity\Thread;
use App\Entity\Commentaire;
use App\Form\ThreadType;
use App\Form\CommentaireType;
use App\Repository\ThreadRepository;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/thread")
 */
class ThreadController extends AbstractController
{
	/**
     * @Route("/", name="thread_index")
     */
    public function index(ThreadRepository $threadRepository)
    {
        $threads = $threadRepository->findAll();

        return $this->render('thread/index.html.twig', ['threads' => $threads]);
    }
	
	/**
     * @Route("/mypost", name="thread_user")
     */
    public function myPublications(ThreadRepository $threadRepository)
    {
        $threads = $threadRepository->searchThreadByUserId($this->getUser()->getId());

        return $this->render('thread/index_user.html.twig', ['threads' => $threads]);
    }
	
	
	/**
     * @Route("/new", name="new_thread", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $thread = new Thread();
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$thread->setUserID($this->getUser()->getId());
			$thread->setUsername($this->getUser()->getUsername());
			$thread->setPublication(new DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($thread);
            $entityManager->flush();

            return $this->redirectToRoute('thread_index');
        }

        return $this->render('thread/new.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }
	
	/**
     * @Route("/{id}", name="thread_show", methods={"GET", "POST"})
     */
    public function show(Thread $thread, CommentaireRepository $commentaireRepository, Request $request): Response
    {
		$commentaires = $commentaireRepository->getCommentsByThreadId($thread->getId());
		
		$commentaire = new Commentaire();
		$form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$commentaire->setUserID($this->getUser()->getId());
			$commentaire->setThreadID($thread->getId());
			$commentaire->setUsername($this->getUser()->getUsername());
			$commentaire->setPublication(new DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('thread_show', ['id' => $thread->getId()]);
        }
		
        return $this->render('thread/show.html.twig', [
            'thread' => $thread,
			'commentaires' => $commentaires,
			'form' => $form->createView(),
        ]);
    }
	
	
	/**
     * @Route("/{id}/delete", name="thread_delete", methods={"GET", "POST"})
     */
    public function supprimer(Thread $thread, ThreadRepository $threadRepository)
    {
		$threadRepository->deleteThread($thread->getId());
		
        return $this->redirectToRoute('thread_user');
    }
}