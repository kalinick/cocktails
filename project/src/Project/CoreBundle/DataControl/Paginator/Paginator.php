<?php
namespace Project\CoreBundle\DataControl\Paginator;

use Doctrine\ORM\QueryBuilder;
use Project\CoreBundle\DataControl\Base\DataControl;
use Project\CoreBundle\DataControl\Behaiviour\BindRequestInterface;
use Project\CoreBundle\DataControl\Behaiviour\ModifyQueryBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paginator
 */
class Paginator extends DataControl implements BindRequestInterface, ModifyQueryBuilderInterface
{
    const NAME = 'paginator';

    const DEFAULT_LIMIT = 10;
    const DEFAULT_FIRST_PAGE = 1;

    const QUERY_PAGE = 'page';
    const QUERY_LIMIT = 'limit';

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $firstPage;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $page;

    /**
     * @param int $total
     */
    public function __construct(int $total)
    {
        $this->name = self::NAME;
        $this->limit = self::DEFAULT_LIMIT;
        $this->page = $this->firstPage = self::DEFAULT_FIRST_PAGE;
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getFirstPage(): int
    {
        return $this->firstPage;
    }

    /**
     * @param int $firstPage
     */
    public function setFirstPage(int $firstPage)
    {
        $this->firstPage = $firstPage;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     *
     * @return $this
     */
    public function setTotal(int $total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function bindRequest(Request $request)
    {
        if (($limit = $request->get(self::QUERY_LIMIT)) !== null) {
            $this->setLimit($limit);
        }
        if (($page = $request->get(self::QUERY_PAGE)) !== null) {
            $this->setPage($page);
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
        $qb
            ->setMaxResults($this->getLimit())
            ->setFirstResult(($this->getPage() - 1) * $this->getLimit());

        return $this;
    }

    /**
     * @return string
     */
    public function getSQL() : string
    {
        return 'LIMIT ' . ($this->getPage() - $this->getFirstPage()) * $this->getLimit() . ', ' . $this->getLimit();
    }
}