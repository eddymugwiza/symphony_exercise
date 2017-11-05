<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 16.9.17.
 * Time: 14.46
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TestEntityRepository extends EntityRepository
{
	/**
	 * @param $id
	 * @return mixed
	 */
	public function TestEntityRepository($id){
		return $this->createQueryBuilder('test_entity')
														->andWhere('test_entity.id = :id')
														->setParameter('id',$id)
														->orderBy('test_entity.id','DESC')
														->getQuery()
														->execute()
		;
	}
}