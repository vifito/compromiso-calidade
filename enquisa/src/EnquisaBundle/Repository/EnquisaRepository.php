<?php

namespace EnquisaBundle\Repository;

use Doctrine\ORM\Query\ResultSetMapping;

/**
 * EnquisaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EnquisaRepository extends \Doctrine\ORM\EntityRepository
{
    // TODO: proba de consulta
    public function getEnquisas()
    {
        return $this->createQueryBuilder('e')
            ->addSelect('r')
            ->join('e.respostas', 'r')
            ->addSelect('o')
            ->join('r.opcion', 'o')
            ->addSelect('p')
            ->join('o.pregunta', 'p')

            ->orderBy('p.orde')
            ->getQuery()
            ->getArrayResult();
        
        
    }
    
    public function getTotal()
    {        
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(e.id) FROM EnquisaBundle\Entity\Enquisa e');
        $count = $query->getSingleScalarResult();
        
        return $count;
    }
    
    public function getPreguntaStats($preguntaId)
    {        
        $dql =<<<DQL
SELECT pregunta.id, pregunta.texto, opcion.valor AS label, count(opcion.valor) AS value
FROM EnquisaBundle\Entity\Opcion opcion
JOIN opcion.respostas resposta	
JOIN opcion.pregunta pregunta
WHERE pregunta.id = :preguntaId
GROUP BY opcion.valor, pregunta.texto
ORDER BY opcion.id
DQL;

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(array(
            ':preguntaId' => $preguntaId,
        ));
        
        return $query->getResult();
    }
    
    public function getPreguntas()
    {        
        $dql =<<<DQL
SELECT pregunta.id, pregunta.texto
FROM EnquisaBundle\Entity\Pregunta pregunta
ORDER BY pregunta.orde
DQL;

        $query = $this->getEntityManager()->createQuery($dql);
        
        return $query->getResult();
    }    
}
