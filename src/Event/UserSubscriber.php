<?php

namespace App\Event;

use App\Mailer\Mailer;
use App\Event\UserRegisterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var Mailer
     */
    private $mailer;
    
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;        
    }
    
    public static function getSubscribedEvents()
    {
        return [
            UserRegisterEvent::class => 'onUserRegister'
        ];
    }
    
    public function onUserRegister(UserRegisterEvent $event)
    {
        $this->mailer->sendConfirmationEmail($event->getRegisteredUser());
    }
}