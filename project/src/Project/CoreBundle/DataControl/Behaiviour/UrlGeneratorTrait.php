<?php
namespace Project\CoreBundle\DataControl\Behaiviour;

use Project\CoreBundle\Http\UrlModifier\CurrentUrl;
use Project\CoreBundle\Http\UrlModifier\UrlModifierInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * UrlGeneratorTrait
 */
trait UrlGeneratorTrait
{
    /**
     * @return UrlModifierInterface
     */
    public function getUrlModifier(): UrlModifierInterface
    {
        $urlModifier = $this->getService('url-modifier');

        return null === $urlModifier ? new CurrentUrl() : $urlModifier;
    }

    /**
     * @param Request $request
     * @param mixed   $value
     *
     * @return string
     */
    public function getUrl(Request $request, $value): string
    {
        $params[$this->getName()] = $value;

        return $this->getUrlModifier()->getUrl($request, $params);
    }
}