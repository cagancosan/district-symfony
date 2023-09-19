<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use App\Service\MailService;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class OrderSubscriber implements EventSubscriber
{
    private $mailer;

    public function __construct(MailService $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof \App\Entity\Commande) {
            $user = $entity->getUtilisateur();
            $orderid = $entity->getId();
            $message = "Nous accusons la réception de votre commande n°" . $orderid . "\n";
            $message .= "Voici le récapitulatif de votre commande : \n";
            $message .= "TODO DETAILS";

            $this->mailer->sendEmailUser('the@district.com', $user->getEmail(), 'Validation de votre commande n°' . $orderid, $message, $user->getNom() . $user->getPrenom());
        }
    }
}
