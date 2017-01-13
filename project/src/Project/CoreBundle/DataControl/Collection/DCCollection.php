<?php
namespace Project\CoreBundle\DataControl\Collection;

use Project\CoreBundle\DataControl\Base\DataControl;
use Project\CoreBundle\DataControl\Behaiviour\BindRequestInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DCCollection
 */
class DCCollection extends DataControl implements BindRequestInterface
{
    /**
     * @var array
     */
    private $collection = [];

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function bindRequest(Request $request)
    {
        foreach ($request->get($this->getName(), []) as $key => $value) {
            $this->collection[$key] = $value;
        }

        return $this;
    }
}