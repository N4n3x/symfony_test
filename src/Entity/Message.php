<?php
namespace App\Entity;

class Message{
    private $mail_client;
    private $corps;

    /**
     * @return mixed
     */
    public function getMailClient()
    {
        return $this->mail_client;
    }

    /**
     * @param mixed $mail_client
     */
    public function setMailClient($mail_client): void
    {
        $this->mail_client = $mail_client;
    }

    /**
     * @return mixed
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * @param mixed $corps
     */
    public function setCorps($corps): void
    {
        $this->corps = $corps;
    }

}