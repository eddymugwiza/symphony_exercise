<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 5.11.17.
 * Time: 19.13
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
	public function loadOrdersByItemsPrice()
	{
		return $this->createQueryBuilder('orders')
												->andWhere('orders.status = :status')
												->setParameter('status','pending')
												->leftJoin('orders.orderItems','order_items')
												->orderBy('order_items.price','DESC')
												->getQuery()
												->execute();
	}
}