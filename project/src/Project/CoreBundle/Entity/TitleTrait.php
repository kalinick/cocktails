<?php
namespace Project\CoreBundle\Entity;

/**
 * Trait TitleTrait
 */
trait TitleTrait
{
    /**
     * @ORM\Column(type="string", name="title", length=255, nullable=true)
     *
     * @var null|string
     */
    private $title;

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     *
     * @return $this
     */
    public function setTitle(string $title = null)
    {
        $this->title = $title;

        return $this;
    }
}