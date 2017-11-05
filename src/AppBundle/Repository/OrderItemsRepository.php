<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 28.10.17.
 * Time: 21.28
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Order;
use Doctrine\ORM\EntityRepository;

class OrderItemsRepository extends EntityRepository
{
	public function initByOrderId($orderId)
	{
		return $this->createQueryBuilder('order_items')
												->andWhere('order_items.orderId = :orderId')
												->setParameter('orderId',$orderId)
												->getQuery()
												->execute();
	}

	public function findItemsByPriceFiltered(Order $order)
	{
		return $this->createQueryBuilder('order_items')
			->andWhere('order_items.price > :price')
			->setParameter('price',80)
			->andWhere('orders = :order')
			->setParameter('order', $order)
			->getQuery()
			->execute();
	}

}