<?php

namespace Alexlg89\LaravelExceptionSlacker;

class SlackNotificationMessage
{
    protected $exception;
    protected $text;
    protected $attachment = null;

    /**
     * SlackNotificationMessage constructor.
     * @param \Exception $exception : Thrown exception
     */
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;

        $this->loadText();
        $this->loadAttachment();
    }

    /**
     * Loads the text from config and replaces the placeholders.
     */
    protected function loadText()
    {
        $text = config('exception-slacker.text');
        $text = str_replace('{{APP_NAME}}', env('APP_NAME'), $text);
        $text = str_replace('{{APP_URL}}', env('APP_URL'), $text);
        $text = str_replace('{{CODE}}', $this->exception->getCode(), $text);
        $text = str_replace('{{MESSAGE}}', $this->exception->getMessage(), $text);
        $text = str_replace('{{FILE}}', $this->exception->getFile(), $text);
        $text = str_replace('{{LINE}}', $this->exception->getLine(), $text);
        $text = str_replace('{{TRACE}}', $this->exception->getTraceAsString(), $text);

        $this->text = $text;
    }

    /**
     *  Builds the attachment.
     */
    protected function loadAttachment()
    {
        if (config('exception-slacker.show_attachment') === true) {
            $this->attachment = [];
            $this->attachment[] = [
                'title' => $this->exception->getMessage(),
                'text' => '_' . $this->exception->getFile() . " on line " . $this->exception->getLine() . "_" .
                    "\n```" . $this->exception->getTraceAsString() . "```",
                'color' => '#FF4F4C',
                'mrkdwn_in' => ["title", "text"]
            ];
        }
    }

    /**
     * Put the Values into the Placeholders.
     *
     * @param $template
     * @return mixed
     */
    protected function replacePlaceholders($template)
    {
        $template = str_replace('{{CODE}}', $this->exception->getCode(), $template);
        $template = str_replace('{{MESSAGE}}', $this->exception->getMessage(), $template);
        $template = str_replace('{{FILE}}', $this->exception->getFile(), $template);
        $template = str_replace('{{LINE}}', $this->exception->getLine(), $template);
        $template = str_replace('{{TRACE}}', $this->exception->getTraceAsString(), $template);

        return $template;
    }

    /**
     * Return the text.
     *
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Return the attachment.
     *
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
}