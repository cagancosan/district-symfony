<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use App\Service\MailService;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ContactSubscriber implements EventSubscriber
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
        if ($entity instanceof \App\Entity\Contact) {
            $objet = $entity->getObjet();
            $message = $entity->getMessage();
            if (preg_match("/rgpd\b/i", $objet) || preg_match("/rgpd\b/i", $message)) {
                $message = "Un nouveau message en rapport avec la loi sur les RGPD vous a été envoyé !";
                $message .= "L'id du message :" . $entity->getId();
                $message .= "Objet du message :" . $entity->getObjet();
                $message .= "Texte du message :" . $entity->getMessage();
                $this->mailer->sendEmail('rgpd@district.com', 'the@district.com', 'Alerte RGPD !!!', '');
            }
        }
    }
}
