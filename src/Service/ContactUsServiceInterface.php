<?php

namespace App\Service;

use App\DTO\ContuctUsPage;

/**
 * Contract for contuct us page service.
 *
 * @author Sergey R <qwe@qwe.com>
 */
interface ContactUsServiceInterface
{
    /**
     * Gets contact us page data.
     *
     * @return ContuctUsPage
     */
    public function getData(): ContuctUsPage;
}
