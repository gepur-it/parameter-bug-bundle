<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 08.12.17
 */

namespace GepurIt\ParameterBugBundle\ParameterBug;

use GepurIt\ParameterBugBundle\Entity\Parameter;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ParameterBug
 * @package ClientsEmailsBundle\ParameterBug
 */
class ParameterBug
{
    const VAR_UNPROCESSED_LIST_ENABLED = 'unprocessed_list_enabled';

    /** @var EntityManagerInterface|EntityManager  */
    private $entityManager;

    /**
     * ParameterBug constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $name
     * @param null $defaultValue
     * @return null
     */
    public function get(string $name, $defaultValue = null)
    {
        $loadedParam = $this->entityManager->find(Parameter::class, $name);
        if (null === $loadedParam) {
            return $defaultValue;
        }

        return $loadedParam->getValue();
    }

    /**
     * @param string $name
     *
     * @return Parameter|null
     */
    public function getParameterEntity(string $name)
    {
        $loadedParam = $this->entityManager->find(Parameter::class, $name);

        return $loadedParam;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function save(string $name, $value)
    {
        $loadedParam = $this->entityManager->find(Parameter::class, $name);
        if (null === $loadedParam) {
            $loadedParam = new Parameter($name);
        }
        $loadedParam->setValue($value);
        $this->entityManager->persist($loadedParam);
        $this->entityManager->flush($loadedParam);
    }

    /**
     * @param string $name
     * @param $value
     */
    public function set(string $name, $value)
    {
        $this->save($name, $value);
    }
}
