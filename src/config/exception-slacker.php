<?php

return [
    'slack_webhook_url' => 'YOUR WEBHOOK HERE',
    'default_channel' => 'general',
    'username' => 'Slack Exception Bot',
    'emoji' => ':smiley:',

    /*
     *  Available Placeholders for text:
     *
     *  {{APP_NAME}}, {{APP_URL}}, {{MESSAGE}}, {{FILE}}, {{LINE}}, {{TRACE}}, {{CODE}}
     *
     * {{APP_NAME}} and {{APP_URL}} are the values from the .env-File
     *
     */
    'text' => "*Exception at {{APP_NAME}}* ({{APP_URL}})",

	/**
	 *	The attachment holds the exception informations
	 */
    'show_attachment' => true
];