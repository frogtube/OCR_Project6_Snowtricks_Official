<?php
/**
 * Created by PhpStorm.
 * User: Ana
 * Date: 12/02/2018
 * Time: 17:04
 */

namespace App\Form\DataTransformer;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Form\DataTransformerInterface;

class ManyToEntityTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $class;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->class = $class;
    }

    /**
     * Transforms an object (use) to a string (id).
     *
     * @param  array           $array
     * @return ArrayCollection
     */
    public function transform($array)
    {
        $newArray = array();

        if (!($array instanceof PersistentCollection)) {
            return new ArrayCollection();
        }

        foreach ($array as $key => $value) {
            $newArray[] = $value;
        }

        return new ArrayCollection($newArray);
    }

    /**
     * Transforms a string (id) to an object (item).
     *
     * @param  string $id
     * @return PersistentCollection|ArrayCollection
     */
    public function reverseTransform($array)
    {
        $newArray = array();

        if (!$array) {
            return new ArrayCollection();
        }

        foreach ($array as $key => $value) {
            $item = $this->em
                ->getRepository($this->class)
                ->findOneBy(array('id' => $value))
            ;

            if (!is_null($item)) {
                $newArray[$key] = $item;
            }
        }

        return new PersistentCollection($this->em, $this->class, new ArrayCollection($newArray));
    }
}
