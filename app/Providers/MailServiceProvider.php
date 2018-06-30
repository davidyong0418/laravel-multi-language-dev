<?php
// app/Providers/MailServiceProvider.php
namespace App\Providers;
use App\Services\Mailer;
class MailServiceProvider extends \Illuminate\Mail\MailServiceProvider
{
    public function register()
    {
        $this->registerSwiftMailer();
        $this->app->singleton('mailer', function ($app) {
            // Once we have create the mailer instance, we will set a container instance
            // on the mailer. This allows us to resolve mailer classes via containers
            // for maximum testability on said classes instead of passing Closures.
            $mailer = new Mailer(
                $app['view'], $app['swift.mailer'], $app['events']
            );
            $this->setMailerDependencies($mailer, $app);
            // If a "from" address is set, we will set it on the mailer so that all mail
            // messages sent by the applications will utilize the same "from" address
            // on each one, which makes the developer's life a lot more convenient.
            $from = $app['config']['mail.from'];
            if (is_array($from) && isset($from['address'])) {
                $mailer->alwaysFrom($from['address'], $from['name']);
            }
            $to = $app['config']['mail.to'];
            if (is_array($to) && isset($to['address'])) {
                $mailer->alwaysTo($to['address'], $to['name']);
            }
            // If a "reply to" address is set, we will set it on the mailer so that each
            // message sent by the application will utilize the same address for this
            // setting. This is more convenient than specifying it on each message.
            $replyTo = $app['config']['mail.reply_to'];
            if (is_array($replyTo) && isset($replyTo['address'])) {
                $mailer->alwaysReplyTo($replyTo['address'], $replyTo['name']);
            }
            return $mailer;
        });
    }
}