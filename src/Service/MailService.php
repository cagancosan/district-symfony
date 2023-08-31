<?php

namespace App\Service;

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Part\File;
use Symfony\Component\Mime\Part\DataPart;
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
                ->to(new Address($to, 'pseudonyme'))
                ->addPart(new DataPart(new File('build/assets/files/birds.pdf')))
                ->subject($subject)
                ->htmlTemplate('mail/contact.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'nick' => 'pseudonyme',
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
