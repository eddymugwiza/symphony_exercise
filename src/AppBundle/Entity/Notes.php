<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 4.9.17.
 * Time: 19.54
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Repository\NotesRepository;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotesRepository")
 * @ORM\Table(name="notes")
 */
class Notes
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $note;

	/**
	 * @ORM\ManyToOne("testEntity")
	 */
	private $testEntity;

	/**
	 * @return mixed
	 */
	public function getTestEntity()
	{
		return $this->testEntity;
	}

	/**
	 * @param mixed $testEntity
	 */
	public function setTestEntity($testEntity)
	{
		$this->testEntity = $testEntity;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getNote()
	{
		return $this->note;
	}

	/**
	 * @param mixed $note
	 */
	public function setNote($note)
	{
		$this->note = $note;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt()
	{
		return new \DateTime('-'.rand(0, 100).' days');
	}


}