<?php
namespace NV\MiniFram;

class Mailer
{
    protected $server;
    protected $username;
    protected $password;
    protected $port;
    protected $emailTo;
    protected $encryption;
    protected $mailer;

    const PORTS = [25, 587, 465, 2525, 4065, 25025];
    const ENCRYPTIONS = ['ssl', 'tls'];

    use Hydrator;

    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
        $transport = new \Swift_SmtpTransport($this->server, $this->port, $this->encryption);
        $transport->setUsername($this->username)
                  ->setPassword($this->password);

        $this->mailer = new \Swift_Mailer($transport);
    }

    public function send(Mail $message)
    {
        $mail = new \Swift_Message($message->getTitle());
        $mail->setFrom([$this->username])
           ->setTo([$this->emailTo])
           ->setBody($message->createBody());

        return $this->mailer->send($mail);
    }

    public function setServer($server)
    {
        if (is_string($server)) {
            $this->server = $server;
        }
    }

    public function setUsername($username)
    {
        if (is_string($username)) {
            $this->username = $username;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    public function setPort($port)
    {
        if (in_array((int) $port, self::PORTS)) {
            $this->port = (int) $port;
        }
    }

    public function setEncryption($encryption)
    {
        if (in_array($encryption, self::ENCRYPTIONS)) {
            $this->encryption = $encryption;
        }
    }

    public function setEmailTo($emailTo)
    {
        if (is_string($emailTo)) {
            $this->emailTo = $emailTo;
        }
    }
}
