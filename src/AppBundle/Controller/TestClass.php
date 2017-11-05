<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Notes;
use AppBundle\Entity\TestEntity;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;

class TestClass extends Controller
{
	/**
	 * @Route("insertNote", name="insertNote")
	 * @return Response
	 */
	public function insertNewNote(){

		$response = 'ERROR!!!';
		try {
			$notesObject = new Notes();
			$em = $this->getDoctrine()->getManager();
			$note = 'this is my first note!';

			$notesObject->setNote($note);
			$em->persist($notesObject);

			$em->flush();
			$response = 'yeah! we added our note to DB!';
		} catch (\Exception $e){
			$response = 'ERROR';
		}

		$html = '<html><body>'.$response.'</body></html>';


		return new Response($html);

	}

	/**
	 * @Route("getAllNotes", name="get_all_notes")
	 * @return Response
	 */
	public function getAllNotes(){
		$em = $this->getDoctrine()->getManager();


		$notesCollection = $em->getRepository('AppBundle:Notes');

		$all = $notesCollection->findAll();

		$template = 'test/notes.html.twig';

//		dump($all);
//		die();

		return $this->render($template, [
			'notes' => $all
		]);

	}

	/**
	 * @Route("add/addNew",name="add_new_object_to_db")
	 * @return Response
	 */
	public function addNew(){
		$entityManager = $this->getDoctrine()->getManager();
		$testEntity = new TestEntity();

		$testEntity->setName('Dejana');
		$testEntity->setLastName('Brankovic');
		$testEntity->setAddress('savska 57a BG');

		$entityManager->persist($testEntity);
		$entityManager->flush();

		return new Response('<html<body><div>New record added</div></body></html>');

	}

	/**
	 * @Route("test/getAll")
	 */
	public function getAll(){

		$entityManager = $this->getDoctrine()->getManager();

		$all = $entityManager->getRepository('AppBundle:TestEntity')->findAll();

		dump($all); die();
	}

	/**
	 * @Route("test/renderAll",name="render_all")
	 */
	public function getAllAndMakeTable(){
		$entityManager = $this->getDoctrine()->getManager();

		$all = $entityManager->getRepository('AppBundle:TestEntity')->findAll();

		$template = 'test/allFromDB.html.twig';

		$html = $this->render($template,[
			'users'=> $all
		]);

		return $html;
	}

	/**
	 * @Route("getNotes/{note}", name="get_notes")
	 * @param $note
	 * @return JsonResponse
	 */
	public function getNotes($note){
		$data = array();
		$notes = array(
			'first note',
			'second note',
			'third note'
		);



		$data = array(
			'notes' => $notes,
			'name'=> $note
		);
		return new JsonResponse($data);
	}

	/**
	 * @Route("test/{name}")
	 * @param $name
	 * @return Response
	 */
	public function test($name){

		$notes = array(
			'first note',
			'second note',
			'third note'
		);
		$headerTxt = 'The owner is *Eddy*';
		$markdownParser = $this->get('markdown.parser');

		$headerTxt = $markdownParser->transform($headerTxt);
		$template = 'test/test.html.twig';

		$key = md5($headerTxt);
		$cache = $this->get('doctrine_cache.providers.my_doctrine_cache');

		if($cache->contains($key)){
			$headerTxt = $cache->fetch($key);
		}else{
			$cache->save($key, $headerTxt);
		}

		$rootDir = $this->get('kernel');

		return $this->render($template, [
			'name' => $name,
			'notes' => $notes,
			'header_text' => $headerTxt,
			'number'=> 99999
		]);
	}

	/**
	 * @Route("welcome/{name}")
	 * @return Response
	 */
	public function welcomeBackMessageRender($name){
		$html = 'welcome '.$name;

		$template = 'test/test1.html.twig';

		$markdown = $this->get('markdown.parser');

		$funFact = 'Here is our new *customer* company';

		$funFact = $markdown->transform($funFact);

		$notes = array(
			'note1','note2','note3'
		);

		return $this->render($template,[
			'name'=>$name,
			'notes' => $notes,
			'funFact' => $funFact
		]);
	}

	/**
	 * @param $userName
	 * @Route("getUser/{userName}", name="get_user")
	 * @return Response
	 */
	public function getOneUserAndDisplayIt($userName){
		$template = 'test/displayOneNoteByUserName.html.twig';

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('AppBundle:TestEntity')
				->findOneBy(['name'=> $userName]);

		if(!$user) {
			throw $this->createNotFoundException('User not found maaaan!');
		}

		return $this->render($template, [
			'user'=> $user
		]);
	}

	/**
	 * @param $name
	 * @Route("getNotesByName/{name}", name="get_notes_by_name")
	 * @return Response
	 */
	public function getNotesByName($name){

		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Notes');

		$notes = $repository->findAllByName($name);

		return $this->render('test/displayOneNoteByUserName.html.twig',[
			'notes' => $notes
		]);
	}

	/**
	 * @param $id
	 * @Route("getUserById/{id}", name="get_user_by_id")
	 * @return Response
	 */
	public function getUserById($id){
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:TestEntity');

		$users = $repository->findbyId($id);
		$template = 'test/displayOneNoteByUserName.html.twig';

		return $this->render($template, [
			'users' => $users
		]);
	}

	/**
	 * @Route("addNewUser",name="add_new_user")
	 * @return Response
	 */
	public function addNewUser(){

		$em = $this->getDoctrine()->getManager();
		$userObj = new TestEntity();

		$userObj->setName('Eddy');
		$userObj->setLastName('Mugwiza');

		$em->persist($userObj);
		$em->flush();

		return new Response('<html><body>New user added </body></html>');
	}



}
