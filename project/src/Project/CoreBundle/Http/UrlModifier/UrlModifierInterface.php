<?php
namespace Project\CoreBundle\Http\UrlModifier;

use Symfony\Component\HttpFoundation\Request;

/**
 * UrlModifierInterface
 */
interface UrlModifierInterface
{
    /**
     * @param Request $request
     * @param array   $modifiers
     *
     * @return string
     */
    public function getUrl(Request $request, array $modifiers): string;
}