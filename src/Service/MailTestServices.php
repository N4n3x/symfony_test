<?php
namespace App\Service;

use App\Entity\Message;
use App\Entity\Produit;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailTestServices{
    private $mailer;
    private $renderer;

    public function __construct(MailerInterface $mail, Environment $renderer)
    {
        $this->mailer = $mail;
        $this->renderer = $renderer;
    }

    public function testSend(Produit $produit, Message $message){
        $message = (new Email())
            ->from('alex.hern.dev@gmail.com')
            ->to('alex.hern.dev@gmail.com')
            ->replyTo('alex.hern.dev@gmail.com')
            ->subject("Mail de test")
            ->html($this->renderer->render('mail/testMail.html.twig',['produit' => $produit, 'message' => $message]));
        $this->mailer->send($message);
    }
}