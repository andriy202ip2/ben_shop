<?php

namespace Shop\MenuBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ItemsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemsRepository extends EntityRepository {

    public function findBySerchCodeOrderedById($serch) {
                  
        //echo $serch;
        $query = $this->createQueryBuilder('i')
            ->where('i.itemId LIKE :serch')
            ->setParameter('serch', '%'.$serch.'%');
                
        $query = $query->orderBy('i.id', 'ASC')
                 ->getQuery();
        
       // echo $query->getSQL();
        
        return $query->getResult();
        
    }    
    
    public function findByIdOrderedById($model_id, $auto_id, $data_id, $side, $t, $t1, $t2, $t3) {

        $tId = "";
        if($t){

            $arr = array();
            if ($t2){
                $arr[] = 2;
            }
            if ($t1){
                $arr[] = 3;
            }
            if ($t3){
                $arr[] = 5;
            }

            $tId = " and i.tId IN(".implode(",",$arr).")";

        }

        $sideId = $side ? " and i.sideId = :side" : ""; 
                
        $query = $this->createQueryBuilder('i')
            ->andwhere('i.modelMenuId = :model_id and i.autoMenuId = :auto_id and i.dataMenuId = :data_id'.$sideId.$tId)
            ->setParameter('model_id', $model_id)
            ->setParameter('auto_id', $auto_id)
            ->setParameter('data_id', $data_id);
        
        if ($side) {
            $query = $query->setParameter('side', $side);                
        }

        $query = $query->orderBy('i.id', 'ASC')
                 ->getQuery();
        return $query->getResult();
        
    }
    
}
