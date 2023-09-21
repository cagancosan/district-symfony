<?php

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Doctrine\ORM\Events;
use App\Service\MailService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\OnFlushEventArgs;
use NumberFormatter;

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
            Events::onFlush,
        ];
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        /**
         * @var EntityManager
         */
        $em = $args->getObjectManager();
        $uow = $em->getUnitOfWork();
        $message = $messageDetails = "";
        $user = new Utilisateur();
        $price = new NumberFormatter("fr", NumberFormatter::CURRENCY);
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof \App\Entity\Detail) {
                $messageDetails .= "x" . $entity->getQuantite() . " " . $entity->getPlat()->getLibelle() . " - " . $price->formatCurrency($entity->getPlat()->getPrix(), "EUR") . "\n";
            }
            if ($entity instanceof \App\Entity\Commande) {
                $user = $entity->getUtilisateur();
                $orderid = $entity->getId();
                $message .= "Voici le récapitulatif de votre commande : \n";
                $message .= $messageDetails;
                $message .= "Total: " . $price->formatCurrency($entity->getTotal(), "EUR");
                $this->mailer->sendEmailUser('the@district.com', $user->getEmail(), 'Validation de votre commande' . $orderid, $message, $user->getNom() . $user->getPrenom());
            }
        }
    }
}
