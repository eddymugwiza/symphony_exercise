<?php
/**
 * Created by PhpStorm.
 * User: eddy
 * Date: 16.9.17.
 * Time: 12.57
 */

namespace AppBundle\Repository;



use Doctrine\ORM\EntityRepository;

class NotesRepository extends EntityRepository
{
	public function findAllByName($note)
	{
		return $this->createQueryBuilder('notes')
												->andWhere('notes.note = :note')
												->setParameter('note',$note)
												->orderBy('notes.id','DESC')
												->getQuery()
												->execute();
	}
}