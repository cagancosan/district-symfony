<?php

namespace App\Service;

use Exception;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($from, $to, $subject, $message): bool
    {
        try {
            $email = (new TemplatedEmail())
                ->from($from)
                ->to(new Address($to))
                ->subject($subject)
                ->htmlTemplate('mail/contact.html.twig')
                ->context([
                    'to' => $to,
                    'message' => $message,
                ]);
            $this->mailer->send($email);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function sendEmailUser($from, $to, $subject, $message, $nick): bool
    {
        try {
            $email = (new TemplatedEmail())
                ->from($from)
                ->to(new Address($to, $nick))
                ->subject($subject)
                ->htmlTemplate('mail/contact.html.twig')
                ->context([
                    'nick' => $nick,
                    'to' => $to,
                    'message' => $message,
                ]);
            $this->mailer->send($email);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
