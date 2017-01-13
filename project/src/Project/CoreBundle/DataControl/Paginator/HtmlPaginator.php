<?php
namespace Project\CoreBundle\DataControl\Paginator;

use Project\CoreBundle\DataControl\Behaiviour\UrlGeneratorInterface;
use Project\CoreBundle\DataControl\Behaiviour\UrlGeneratorTrait;
use Project\CoreBundle\DataControl\Html\TemplateInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * HtmlPaginator
 */
class HtmlPaginator extends Paginator implements TemplateInterface, UrlGeneratorInterface
{
    use UrlGeneratorTrait;

    const DEFAULT_VISIBLE_PAGE_COUNT = 5;

    /**
     * @var int
     */
    protected $visiblePagesCount = self::DEFAULT_VISIBLE_PAGE_COUNT;

    /**
     * @return int
     */
    public function getVisiblePagesCount(): int
    {
        return $this->visiblePagesCount;
    }

    /**
     * @param int $visiblePagesCount
     *
     * @return $this
     */
    public function setVisiblePagesCount(int $visiblePagesCount)
    {
        $this->visiblePagesCount = $visiblePagesCount;

        return $this;
    }

    /**
     * @return int
     */
    public function countPages(): int
    {
        return (int) ceil($this->getTotal() / $this->getLimit());
    }

    /**
     * @return int
     */
    public function getMinPage(): int
    {
        $minPage = $this->getPage() - floor($this->getVisiblePagesCount() / 2);

        return $minPage > $this->getFirstPage() ? $minPage : $this->getFirstPage();
    }

    /**
     * @return int
     */
    public function getMaxPage(): int
    {
        $maxPage = $this->getMinPage() + $this->getVisiblePagesCount() - $this->getFirstPage();
        $countPages = $this->countPages();

        return $maxPage > $countPages ? $countPages : $maxPage;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'ProjectCoreBundle:DataControl:paginator.html.twig';
    }

    /**
     * @param Request $request
     * @param mixed   $value
     *
     * @return string
     */
    public function getUrl(Request $request, $value): string
    {
        $params[self::QUERY_PAGE] = $value;

        return $this->getUrlModifier()->getUrl($request, $params);
    }
}