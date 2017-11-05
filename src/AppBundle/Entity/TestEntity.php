<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 7.8.17.
 * Time: 16.00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestEntityRepository")
 * @ORM\Table(name="test_entity")
 */
class TestEntity
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
	private $name;

	/**
	 * @ORM\Column(type="string")
	 */
	private $lastName;

	/**
	 * @ORM\Column(type="string",nullable=true)
	 */
	private $address;

	/**
	 * @ORM\Column(type="integer",nullable=true);
	 */
	private $jmbg;

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param mixed $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param mixed $address
	 */
	public function setAddress($address)
	{
		$this->address = $address;
	}

	/**
	 * @return mixed
	 */
	public function getJmbg()
	{
		return $this->jmbg;
	}

	/**
	 * @param mixed $jmbg
	 */
	public function setJmbg($jmbg)
	{
		$this->jmbg = $jmbg;
	}


}