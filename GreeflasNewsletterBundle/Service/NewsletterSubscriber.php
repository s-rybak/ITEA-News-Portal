<?php

namespace Greeflas\Bundle\NewsletterBundle\Service;

use Greeflas\Bundle\NewsletterBundle\Dto\Subscriber;

final class NewsletterSubscriber implements NewsletterSubscriberInterface
{
    public function save(Subscriber $subscriber)
    {
        die(var_dump($subscriber->getEmail()));
    }
}
