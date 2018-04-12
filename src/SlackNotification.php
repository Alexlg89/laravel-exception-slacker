<?php

namespace Alexlg89\LaravelExceptionSlacker;

use Illuminate\Support\Facades\Log;

class SlackNotification
{
    /**
     * Sends a Slack Notification with the given Message
     *
     * @param $message
     * @return null
     */
    public static function send(SlackNotificationMessage $message)
    {
        $ch = curl_init(config('exception-slacker.slack_webhook_url'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, self::getPayload($message));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        if($result != 'ok') {
            Log::error('Laravel Exception Slacker: Curl - ' . $result);
        }
    }

    /**
     * Prepares the payload for the Slack Notification
     *
     * @param SlackNotificationMessage $message
     * @return string
     */
    protected static function getPayload(SlackNotificationMessage $message)
    {
        $payload = [
            'text' => $message->getText(),
            'channel' => self::getChannel(),
            'username' => self::getUsername(),
            'icon_emoji' => self::getEmoji()
        ];

        if ($message->getAttachment() !== null) {
            $payload['attachments'] = $message->getAttachment();
        }

        return "payload=" . json_encode($payload);
    }

    /**
     * Returns the Username
     * If not set it will return the APP_NAME from the .env-File
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    protected static function getUsername()
    {
        $username = config('exception-slacker.username');
        if ($username === null) {
            return env('APP_NAME');
        }

        return $username;
    }

    /**
     * Returns the Channel
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    protected static function getChannel()
    {
        return config('exception-slacker.default_channel');
    }

    /**
     * Returns the Emoji
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    protected static function getEmoji()
    {
        return config('exception-slacker.emoji');
    }
}