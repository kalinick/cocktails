<?php
namespace Project\CoreBundle\Http\UrlModifier;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * CurrentUrl
 */
class CurrentUrl implements UrlModifierInterface
{
    /**
     * @param Request $request
     * @param array   $modifiers
     *
     * @return string
     */
    public function getUrl(Request $request, array $modifiers): string
    {
        $query = clone $request->query;
        $this->modifyQuery($query, $modifiers);

        return $request->getUriForPath($request->getPathInfo() . $this->getQueryString($query));
    }

    /**
     * @param ParameterBag $query
     * @param array        $modifiers
     */
    protected function modifyQuery(ParameterBag $query, array $modifiers)
    {
        foreach ($modifiers as $key => $value) {
            switch (true) {
                case $value === null:
                    $query->remove($key);
                    break;
                case is_array($value):
                    $query->set($key, array_replace_recursive($query->get($key, []), $value));
                    break;
                default:
                    $query->set($key, $value);
                    break;
            }
        }
    }

    /**
     * @param ParameterBag $query
     *
     * @return string
     */
    protected function getQueryString(ParameterBag $query)
    {
        $queryString = Request::normalizeQueryString(http_build_query($query->all(), null, '&'));
        $queryString = $queryString === '' ? '' : '?' . $queryString;

        return $queryString;
    }
}