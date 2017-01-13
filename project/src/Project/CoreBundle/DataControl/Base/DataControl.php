<?php
namespace Project\CoreBundle\DataControl\Base;

/**
 * DataControl
 */
class DataControl
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var DCContainer|null
     */
    protected $parent;

    /**
     * @var array
     */
    protected $servicesBag = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DCContainer|null
     */
    public function getParent():? DCContainer
    {
        return $this->parent;
    }

    /**
     * @param DCContainer $parent
     *
     * @return $this
     */
    public function setParent(DCContainer $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getService(string $name)
    {
        if (array_key_exists($name, $this->servicesBag)) {
            return $this->servicesBag[$name];
        } else if (null !== $this->getParent()) {
            return $this->getParent()->getService($name);
        } else {
            return null;
        }
    }
}