<?php
namespace Project\CoreBundle\DataControl\Base;

use Doctrine\ORM\QueryBuilder;
use Project\CoreBundle\DataControl\Behaiviour\BindRequestInterface;
use Project\CoreBundle\DataControl\Behaiviour\ModifyQueryBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * DCContainer
 */
class DCContainer extends DataControl implements BindRequestInterface, ModifyQueryBuilderInterface
{
    /**
     * @var DataControl[]
     */
    private $controls = [];

    /**
     * @param DataControl $control
     *
     * @return $this
     */
    public function add(DataControl $control)
    {
        $name = $control->getName();
        if (array_key_exists($name, $this->controls)) {
            throw new \RuntimeException('Data control "' . $name . '" already exists');
        }
        $control->setParent($this);
        $this->controls[$name] = $control;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return DataControl
     */
    public function get(string $name): DataControl
    {
        if (!array_key_exists($name, $this->controls)) {
            throw new \RuntimeException('Data control "' . $name . '" not found');
        }

        return $this->controls[$name];
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function bindRequest(Request $request)
    {
        foreach ($this->controls as $control) {
            if ($control instanceof BindRequestInterface) {
                $control->bindRequest($request);
            }
        }

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    public function modifyQueryBuilder(QueryBuilder $qb)
    {
        foreach ($this->controls as $control) {
            if ($control instanceof ModifyQueryBuilderInterface) {
                $control->modifyQueryBuilder($qb);
            }
        }

        return $this;
    }
}