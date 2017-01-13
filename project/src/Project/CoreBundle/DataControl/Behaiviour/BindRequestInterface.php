<?php
namespace Project\CoreBundle\DataControl\Behaiviour;

use Symfony\Component\HttpFoundation\Request;

/**
 * BindRequestInterface
 */
interface BindRequestInterface
{
    /**
     * @param Request $request
     *
     * @return $this
     */
    public function bindRequest(Request $request);
}
