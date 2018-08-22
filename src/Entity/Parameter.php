<?php

namespace GepurIt\ParameterBugBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Parameter
 * @package GepurIt\ParameterBugBundle\Entity
 *
 * @ORM\Table(name="client_email_parameter")
 * @ORM\Entity(repositoryClass="GepurIt\ParameterBugBundle\Repository\ParameterRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Parameter
{
    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $name = '';

    /**
     * @var mixed
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Parameter constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdated(): void
    {
        $this->updatedAt = new \DateTime("now");
    }
}
