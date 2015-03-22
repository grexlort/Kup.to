<?php
/**
 * Created by PhpStorm.
 * User: tomaszkulka
 * Date: 22.03.2015
 * Time: 13:36
 */

namespace Mmm\ApiBundle\Mailer;

use Mmm\ApiBundle\Entity\Task;
use Mmm\ApiBundle\Entity\User;

class Mailer
{
    protected $mailer;
    protected $twig;
    protected $parameters;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, array $parameters)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->parameters = $parameters;
    }

    public function sendAssignUserToTaskMessage(User $user, Task $task)
    {
        $template = $this->parameters['template']['assign_user_to_task'];
        $context = array(
            'user' => $user,
            'task' => $task
        );

        $this->sendMessage($template, $context, $this->parameters['from_email'], $user->getEmail());
    }

    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {
        $template = $this->twig->loadTemplate($templateName);
        $subject = $template->renderBlock('subject', $context);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail);

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $this->mailer->send($message);
    }
}