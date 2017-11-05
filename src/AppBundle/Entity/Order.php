<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 27.9.17.
 * Time: 17.26
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

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
	 * @ORM\Column(type="string")
	 */
	private $user;

	/**
	 * @ORM\Column(type="string")
	 */
	private $numberOfItems;

	/**
	 * @ORM\Column(type="string")
	 */
	private $created;

	/**
	 * @ORM\Column(type="string")
	 */
	private $type;

	/**
	 * @ORM\Column(type="string")
	 */
	private $status;

	/**
	 * Order constructor.
	 */
	public function __construct()
	{
		$this->orderItems = new ArrayCollection();
	}

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfItems()
	{
		return $this->numberOfItems;
	}

	/**
	 * @param mixed $numberOfItems
	 */
	public function setNumberOfItems($numberOfItems)
	{
		$this->numberOfItems = $numberOfItems;
	}

	/**
	 * @return mixed
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @param mixed $created
	 */
	public function setCreated($created)
	{
		$this->created = $created;
	}


	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function __toString()
	{
		return $this->getStatus();
	}

	/**
	 * @ORM\OneToMany(targetEntity="OrderItems", mappedBy="orders")
	 * @ORM\OrderBy({"name" = "DESC"})
	 */
	private $orderItems;

	/**
	 * @return ArrayCollection
	 */
	public function getOrderItems()
	{
		return $this->orderItems;
	}
}