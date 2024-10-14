<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;

class DeleteImageSubscriber implements EventSubscriberInterface
{
    public function __construct(private KernelInterface $kernel)
    {

    }
    public function onDeleteImage(BeforeEntityDeletedEvent $event): void
    {

        $entity = $event->getEntityInstance();
        if(! $entity instanceof Product){
            return; 
             
        }
        $image = $this->kernel->getProjectDir().'/public/uploadImages/'.$entity->getImageProduct();
        if (file_exists($image)) {
        unlink($image);
        dd($event->getEntityInstance());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityDeletedEvent::class=> 'onDeleteImage',
        ];
    }
}



