<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Default site controller.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class DefaultController
{
    /**
     * Home page.
     *
     * @return Response
     */
    public function index(): Response
    {
        return new Response('<h1>News Portal</h1>');
    }
}
