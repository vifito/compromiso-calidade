<?php
namespace EnquisaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EnquisaBundle\Entity\Pregunta;
use EnquisaBundle\Entity\Opcion;

class LoadPreguntaData implements FixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'texto' => 'A atención recibida por parte do persoal do restaurante considera que foi...',
                'opcions' => [
                    [
                        'valor'  => 'Moi boa',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Boa',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Mellorable',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Mala',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],
            [
                'texto' => 'A cantidade de Cocido que acaba de degustar é',
                'opcions' => [
                    [
                        'valor'  => 'Moi boa',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Boa',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Mellorable',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Mala',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],
            [
                'texto' => 'Considera que o prezo é axeitado',
                'opcions' => [
                    [
                        'valor'  => 'Si',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Non',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],
            [
                'texto' => 'O tempo de espera foi o apropiado',
                'opcions' => [
                    [
                        'valor'  => 'Si',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Non',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],
            [
                'texto' => 'Recomendaría a experiencia de vir a lalín a degustar o Cocido',
                'opcions' => [
                    [
                        'valor'  => 'Si',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Non',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],
            [
                'texto' => 'Recomendaría este establecemento a outra persoa',
                'opcions' => [
                    [
                        'valor'  => 'Si',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Non',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],
            [
                'texto' => 'En xeral, a súa estancia en Lalín foi',
                'opcions' => [
                    [
                        'valor'  => 'Moi boa',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Boa',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Regular',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                    [
                        'valor'  => 'Mala',
                        'width'  => 0,
                        'height' => 0,
                        'x'      => 0,
                        'y'      => 0,
                    ],
                ]
            ],            
        ];
        
        // Cargar as preguntas
        foreach($data as $orde => $preg) {
            $pregunta = new Pregunta();
            $pregunta->setTexto($preg['texto']);
            $pregunta->setOrde($orde);
            
            $manager->persist($pregunta);
            
            // Opcións da pregunta
            foreach($preg['opcions'] as $opc) {
                $opcion = new Opcion();
                $opcion->setValor($opc['valor']);
                $opcion->setWidth($opc['width']);
                $opcion->setHeight($opc['height']);
                $opcion->setX($opc['x']);
                $opcion->setY($opc['y']);                                
                
                $pregunta->addOpcion($opcion);
                $manager->persist($opcion);
            }            
            
            $manager->persist($pregunta);            
            $manager->flush();
        }
       
    }
    
}