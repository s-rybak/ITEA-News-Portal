<?php

namespace Greeflas\Bundle\NewsletterBundle\Service;

use Greeflas\Bundle\NewsletterBundle\Dto\Subscriber;

interface NewsletterSubscriberInterface
{
    public function save(Subscriber $subscriber);
}
