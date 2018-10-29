<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Feedback mail
 * Class MessageRecivedMailer.
 *
 *
 * @author Sergey R
 */
final class MessageRecivedMailer implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $mailer;
    private $supportEmail = 'admin@news-portal.com';

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function setSupportEmail(string $email): void
    {
        $this->supportEmail = $email;
    }

    public function debug()
    {
        die(var_dump($this->supportEmail));
    }

    /**
     * Sands standart feedback email.
     *
     * @param string $mailTo
     *
     * @return bool
     */
    public function send(string $mailTo): bool
    {
        $message = (new \Swift_Message('News Portal: Thank you for feedback'))
        ->setFrom(
            $this->supportEmail
            //$this->container->getParameter('app.support_email')
        )
        ->setTo($mailTo)
        ->setBody('Tank for your feedback. We contact you soon.');

        return (bool) $this->mailer->send($message);
    }
}
