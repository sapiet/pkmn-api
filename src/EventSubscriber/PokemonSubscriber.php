<?php

namespace App\EventSubscriber;

use App\Entity\Pokemon;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class PokemonSubscriber implements EventSubscriberInterface
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getMainRequest();
    }

    public static function getSubscribedEvents()
    {
        return [
            Events::postLoad,
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $pokemon = $args->getObject();

        if (!$pokemon instanceof Pokemon || null === $this->request) {
            return;
        }

        $pokemon->setPicture(sprintf(
            '%s/sprites/%sMS.png',
            $this->request->getSchemeAndHttpHost(),
            str_pad($pokemon->getId(), 3, '0', STR_PAD_LEFT)
        ));

        $pokemon->setThumbnail(sprintf(
            '%s/thumbnails/%s.png',
            $this->request->getSchemeAndHttpHost(),
            str_pad($pokemon->getId(), 3, '0', STR_PAD_LEFT)
        ));
    }
}
