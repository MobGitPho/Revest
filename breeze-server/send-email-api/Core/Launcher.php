<?php

namespace API\EmailSender\Core;

use API\EmailSender\Templates\Basic\BasicModel;
use API\EmailSender\Templates\Simple\SimpleModel;
use API\EmailSender\Templates\Classic\ClassicModel;
use API\EmailSender\Templates\Verification\VerificationModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;

use League\OAuth2\Client\Provider\Google;

class Launcher
{
    private $mail;
    private $data;

    public function __construct($data, $useAlt = false)
    {
        $this->data = $data;
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = (isset($data['smtp_host']) && !empty($data['smtp_host'])) ? $data['smtp_host'] : Constants::HOST;
        $this->mail->Port = (isset($data['smtp_port']) && !empty($data['smtp_port'])) ? $data['smtp_port'] : Constants::PORT;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->AuthType = 'XOAUTH2';
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPAuth = true;

        $settings = $data['settings'] ?? [];

        $clientId = (isset($settings['client_id']) && !empty($settings['client_id'])) ? $settings['client_id'] : ($useAlt ? Constants::CLIENT_ID_ALT : Constants::CLIENT_ID);
        $clientSecret = (isset($settings['client_secret']) && !empty($settings['client_secret'])) ? $settings['client_secret'] : ($useAlt ? Constants::CLIENT_SECRET_ALT : Constants::CLIENT_SECRET);
        $refreshToken = (isset($settings['refresh_token']) && !empty($settings['refresh_token'])) ? $settings['refresh_token'] : ($useAlt ? Constants::REFRESH_TOKEN_ALT : Constants::REFRESH_TOKEN);
        $userName = (isset($settings['username']) && !empty($settings['username'])) ? $settings['username'] : ($useAlt ? Constants::USERNAME_ALT : Constants::USERNAME);

        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret
            ]
        );

        $this->mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $userName
                ]
            )
        );
    }

    public function sendEmail()
    {
        if (
            isset($this->data['from'])
            && isset($this->data['fromName'])
            && isset($this->data['recipients'])
            && isset($this->data['subject'])
        ) {
            try {
                $this->mail->Sender = $this->data['from'];
                $this->mail->addReplyTo($this->data['from'], $this->data['fromName']);
                $this->mail->setFrom($this->data['from'], $this->data['fromName'], false);

                if (isset($this->data['files']) && is_array($this->data['files'])) {
                    for ($i = 0; $i < count($this->data['files']); $i++) {
                        $this->mail->addAttachment(__DIR__ . '/../../sto-api/' . $this->data['files'][$i]);
                    }
                }

                $recipient_list = explode(',', $this->data['recipients']);

                for ($i = 0; $i < count($recipient_list); $i++) {
                    $this->mail->addAddress(trim($recipient_list[$i]));
                }

                $title = (isset($this->data['title']) && !empty($this->data['title'])) ? $this->data['title'] : '';
                $content = (isset($this->data['content']) && !empty($this->data['content'])) ? $this->data['content'] : '';

                $body = $title . '<br>' . $content;

                if (isset($this->data['template'])) {

                    $mustache = new \Mustache_Engine([
                        'entity_flags' => ENT_QUOTES,
                        'loader' => new \Mustache_Loader_FilesystemLoader(__DIR__.'/../Templates'),
                    ]);

                    switch (strtolower($this->data['template'])) {

                        case 'verification':
                            $tpl = $mustache->loadTemplate('Verification/verification');
                            $body = $tpl->render(new VerificationModel($this->data));
                            break;

                        case 'classic':
                            $tpl = $mustache->loadTemplate('Classic/classic');
                            $body = $tpl->render(new ClassicModel($this->data));
                            break;

                        case 'basic':
                            $tpl = $mustache->loadTemplate('Basic/basic');
                            $body = $tpl->render(new BasicModel($this->data));
                            break;

                        case 'simple':
                            $tpl = $mustache->loadTemplate('Simple/simple');
                            $body = $tpl->render(new SimpleModel($this->data));
                            break;

                    }

                }

                $this->mail->isHTML(true);
                $this->mail->Subject = $this->data['subject'];
                $this->mail->Body    = $body;
                $this->mail->AltBody = $title . ' ' . $content;

                $this->mail->send();

                return true;
            } catch (Exception $e) {
                throw new SendEmailException($this->mail->ErrorInfo, 1);

                return false;
            }
        } else {
            throw new \Exception('Essential data are missing', 1);

            return false;
        }
    }
}
