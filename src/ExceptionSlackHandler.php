<?php

namespace Alexlg89\LaravelExceptionSlacker;

use App\Exceptions\Handler;

class ExceptionSlackHandler extends Handler
{
    public function report(\Exception $exception)
    {
        // If Exception should be reported, send Slack Notification.
        if ($this->shouldReport($exception)) {
            SlackNotification::send(new SlackNotificationMessage($exception));
        }

        parent::report($exception);
    }
}