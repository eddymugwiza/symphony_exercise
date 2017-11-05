<?php
/**
 * this class represents order items table in db
 */
namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderItemsRepository")
 * @ORM\Table(name="order_items")
 */
class OrderItems
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
	public function getUnit()
	{
		return $this->unit;
	}

	/**
	 * @param mixed $unit
	 */
	public function setUnit($unit)
	{
		$this->unit = $unit;
	}

	/**
	 * @return mixed
	 */
	public function getOrder()
	{
		return $this->orders;
	}

	/**
	 * @param Order $order
	 */
	public function setOrder(Order $order)
	{
		$this->orders = $order;
	}

	/**
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * @ORM\Column(type="string")
	 */
	private $unit;

	/**
	 * njaah , i had to call it orders because when doctrine is executing
	 * query it consider ORDER as reserved key-word , so , fuck it :)
	 * @ORM\ManyToOne(targetEntity="Order",inversedBy="orderItems")
	 */
	private $orders;

	/**
	 * @ORM\Column(type="string")
	 */
	private $quantity;

	/**
	 * @return mixed
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}

	/**
	 * @param mixed $quantity
	 */
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * @return mixed
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @param mixed $currency
	 */
	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	/**
	 * @ORM\Column(type="string")
	 */
	private $price;

	/**
	 * @ORM\Column(type="string")
	 */
	private $currency;

	public function __toString() {
		return $this->orders;
	}
}