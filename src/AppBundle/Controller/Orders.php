<?php
/**
 * created by almighty Eddy
 * yeah, you will remember this time , when you added simply sfuff
 *
 */

namespace AppBundle\Controller;


use AppBundle\Entity\OrderItems;
use AppBundle\Repository\OrderRepository;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Order;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Repository\OrderItemsRepository;

class Orders extends Controller
{
	/**
	 * @Route("createOrder", name="create_order")
	 */
	public function createNewOrder()
	{
		/**
		 * @var $em EntityManager
		 */
		$em = $this->getDoctrine()->getManager();

		$order = new Order();

		$user = 18824;

		//this we will calculate after we create some order items
		$numberOfitems = 0;

		$created = date('Y-m-d');

		$type = 'POM';

		$status = 'running';

		$order->setUser($user);

		$order->setCreated($created);

		$order->setStatus($status);

		$order->setType($type);

		$order->setNumberOfItems($numberOfitems);

		//lets save order
		$em->persist($order);
		$em->flush();

		//now let's add some order items

		$orderItemDummyArray = array(
			array('name'=>'metal part', 'currency'=> 'OJRO', 'quantity'=>3, 'price'=>100, 'unit' => 'peace','order'=>$order->getId()),
			array('name'=>'plastic part', 'currency'=> 'OJRO', 'quantity'=>2, 'price'=>44, 'unit' => 'peace','order'=>$order->getId()),
			array('name'=>'paper part', 'currency'=> 'OJRO', 'quantity'=>5, 'price'=>82, 'unit' => 'peace','order'=>$order->getId()),
			array('name'=>'some part', 'currency'=> 'OJRO', 'quantity'=>7, 'price'=>24, 'unit' => 'peace','order'=>$order->getId()),
		);

		$this->createOrderItems($orderItemDummyArray, $em, $order);

		return new Response('<html><body>Order successfully created ! Cheers! :)</body></html>');
	}

	/**
	 * @param $orderItemDummyArray
	 * @param EntityManager $em
	 * @param $order Order
	 * @return bool
	 */
	public function createOrderItems($orderItemDummyArray, EntityManager $em, $order)
	{
		foreach ($orderItemDummyArray as $item){
			$orderItem = new OrderItems();
			$orderItem->setName($item['name']);
			$orderItem->setCurrency($item['currency']);
			$orderItem->setPrice($item['price']);
			$orderItem->setUnit($item['unit']);
			$orderItem->setQuantity($item['quantity']);
			$orderItem->setOrder($order);

			$em->persist($orderItem);
			$em->flush();
			unset($orderItem);
		}

		return true;
	}

	/**
	 * @return Response
	 * @param $orderId
	 * @Route("fetchOrder/{orderId}", name="fetch_order_by_id")
	 */
	public function fetchOrder($orderId)
	{
		$orderId = (int)$orderId;
		$em = $this->getDoctrine()->getManager();

		$order = $em->getRepository(Order::class)->find($orderId);

		/**
		 * @var OrderItemsRepository $orderItemsRepository
		 */
		$orderItemsRepository = $em->getRepository(OrderItems::class);

		$orderItems = $orderItemsRepository->initByOrderId($orderId);

		return new Response('<html><body>we fetched our stuff !</body></html>');

	}

	/**
	 * @param OrderItems $orderItems
	 * @Route("getItem/{name}")
	 */
	public function getOrderItemsByName(OrderItems $orderItems)
	{
		dump($orderItems);
		die();
	}

	/**
	 * @return Response
	 * @param Order $order
	 * @Route("getOrder/{id}")
	 */
	public function getOrder(Order $order)
	{
		$items = $order->getOrderItems();


		$template = 'orders/subviews/orders.html.twig';

		return $this->render($template,[
			'items' => $items
		]);
	}

	/**
	 * @param Order $order
	 * @return Response
	 * @Route("getOrdersFiltered/{id}",name="get_orders_filtered")
	 */
	public function getOrdersFiltered(Order $order)
	{

		$template = 'orders/subviews/orders.html.twig';

		$filteredItems = $order->getOrderItems()->filter(
			function (OrderItems $items){
				return $items->getPrice() < 80;
			}
		);

		return $this->render($template,[
			'items' => $filteredItems
		]);
	}

	/**
	 * @param Order $order
	 * @Route("getOrdersByRepo/{id}")
	 * @return Response
	 */
	public function getOrdersFilteredByCustomRepository(Order $order)
	{
		$template = 'orders/subviews/orders.html.twig';
		$em = $this->getDoctrine()->getManager();

		/**
		 * @var OrderItemsRepository $orderItemsRepository
		 */
		$orderItemsRepository = $em->getRepository(OrderItems::class);

		/**
		 * @var OrderItems $orderItems
		 */
		$orderItems = $orderItemsRepository->findItemsByPriceFiltered($order);

		return $this->render($template,[
			'items' => $orderItems
		]);
	}

	/**
	 * @Route("getOrdersOrderByItemsPrice")
	 * @return Response
	 */
	public function getOrderItemsInOrderedBy()
	{
		$template = 'orders/subviews/orders.html.twig';

		$em = $this->getDoctrine()->getManager();
		/**
		 * @var OrderRepository $orderRepository
		 */
		$orderRepository = $em->getRepository(Order::class);

		$orders = $orderRepository->loadOrdersByItemsPrice();

		return $this->render($template,[
			'orders' => $orders
		]);
	}
}