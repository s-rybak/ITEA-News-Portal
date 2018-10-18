<?php

namespace App\Service;

use App\Model\HomePage;

/**
 * Contract for home page service.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
interface HomePageServiceInterface
{
    /**
     * Gets home page data.
     *
     * @return HomePage
     */
    public function getData(): HomePage;
}
