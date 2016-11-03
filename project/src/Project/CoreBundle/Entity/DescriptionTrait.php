<?php


namespace Project\CoreBundle\Entity;

/**
 * Trait DescriptionTrait
 */
trait DescriptionTrait
{
    /**
     * @ORM\Column(type="text", name="description", nullable=true)
     *
     * @var null|string
     */
    private $description;

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     *
     * @return $this
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }
}