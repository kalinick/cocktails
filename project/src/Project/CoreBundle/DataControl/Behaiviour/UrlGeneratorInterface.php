<?php
namespace Project\CoreBundle\DataControl\Behaiviour;

use Project\CoreBundle\Http\UrlModifier\UrlModifierInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * UrlGeneratorInterface
 */
interface UrlGeneratorInterface
{
    /**
     * @return UrlModifierInterface
     */
    public function getUrlModifier(): UrlModifierInterface;

    /**
     * @param Request $request
     * @param mixed   $value
     *
     * @return string
     */
    public function getUrl(Request $request, $value): string;
}