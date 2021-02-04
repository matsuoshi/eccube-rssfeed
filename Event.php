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
            'default_frame.twig' => 'addRssFeedLink',
        ];
    }

    public function addRssFeedLink(TemplateEvent $event)
    {
        $event->addAsset('@SampleRssFeed/head_link.twig');
    }
}
