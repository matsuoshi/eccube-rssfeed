<?php

namespace Plugin\SampleRssFeed;

use Eccube\Event\TemplateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'default_frame.twig' => 'addRssFeedMeta',
        ];
    }

    public function addRssFeedMeta(TemplateEvent $event)
    {
        $event->addAsset('@SampleRssFeed/meta.twig');
    }
}
