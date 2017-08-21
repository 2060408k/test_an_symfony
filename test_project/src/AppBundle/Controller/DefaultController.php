<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chapter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

	/**
	 *  @Rest\Get("/chapters")
	 */
	public function getChaptersAction(Request $request)
	{
		$entityManager = $this->getDoctrine()->getManager();
		/** @var Chapter[] $allChapters */
		$allChapters = $entityManager->getRepository('AppBundle:Chapter')->findAll() ;
		$jsonFormatter = $this->get('json_formatter');
		$response = new JsonResponse($jsonFormatter->toJson($allChapters));
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200/');
		return $response;
	}

	/**
	 *  @Rest\Get("/characters")
	 */
	public function getCharactersAction(Request $request)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$jsonFormatter = $this->get('json_formatter');
		/** @var Chapter[] $allChapters */
		$allCharacters = $entityManager->getRepository('AppBundle:Character')->findAll() ;
		$response = new JsonResponse($jsonFormatter->toJson($allCharacters));
		$response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200/');

		return $response;
	}

    /**
     *  @Rest\Get("/events")
     */
    public function getEventsAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jsonFormatter = $this->get('json_formatter');
        /** @var Chapter[] $allChapters */
        $allEvents = $entityManager->getRepository('AppBundle:Event')->findAll() ;
        $response = new JsonResponse($jsonFormatter->toJson($allEvents));
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200/');

        return $response;
    }
}
