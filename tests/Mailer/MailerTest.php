<?php

namespace App\Tests\Mailer;

use App\Entity\User;
use App\Mailer\Mailer;
use PHPUnit\Framework\TestCase;
use Prophecy\Doubler\ClassPatch\DisableConstructorPatch;

class MailerTest extends TestCase
{
    public function testConfirmationEmail()
    {
        $user = new User();
        $user->setEmail('vini@mail.com');
        
        $swiftMailerMock = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $swiftMailerMock->expects($this->once())->method('send')
            ->with($this->callback(function($subject) {
                $messageStr = (string)$subject;
                return strpos($messageStr, "From: ne@domain.com") !== false
                    && strpos($messageStr, "Content-Type: text/html; charset=utf-8") !== false
                    && strpos($messageStr, "Subject: Welcome to the micropost app") !== false;
            }));
                        
        $twigMock = $this->getMockBuilder(\Twig\Environment::class)
            ->disableOriginalConstructor()
            ->getMock();                        
        $twigMock->expects($this->once())->method('render')
            ->with('email/registration.html.twig', [
                'user' => $user
            ])->willReturn('This is a message body');
        
        $mailer = new Mailer($swiftMailerMock, $twigMock, 'ne@domain.com');
        $mailer->sendConfirmationEmail($user);
    }
}
