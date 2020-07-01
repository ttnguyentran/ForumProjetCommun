<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Form\ThreadSearchForm;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ThreadRepository $threadRepository, Request $request): Response
    {
		$thread = new Thread();
        $form = $this->createForm(ThreadSearchForm::class, $thread);
        $form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$search = $form->get('thread')->getData();
			$threads = $threadRepository->getPubBySearching($search);
			return $this->render('thread/index_search.html.twig', ['threads' => $threads]);
		}
		
        return $this->render('main/index.html.twig', ['form' => $form->createView()]);
    }
	
}
