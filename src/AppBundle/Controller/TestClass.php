<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TestClass extends Controller
{

	/**
	 * @Route("/test/{name}")
	 */
	public function testFunction($name){
		$templateService = $this->container->get('templating');
		$html = 'test/test.html.twig';

		$html = $templateService->render($html,[
			'name' => $name
		]);

		return new Response($html);
	}
}
