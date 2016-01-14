<?php

require_once( 'TelegramBotTypes.php' );

class Telegram
{
    /**
     * Authentication token for the Telegram bot API
     *
     * @var String
     */
    public $api_token;

    /**
     * URL to the API including the API-Token
     *
     * @var String
     */
    public $url;

    /**
     * Name of the Telegram bot
     * this comes from the getMe()-function
     *
     * @var User
     */
    public $bot_information;

    public function __construct( $api_token )
    {
        if( empty( $api_token ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }

        $this->api_token = $api_token;
        $this->url = 'https://api.telegram.org/bot'.$this->api_token.'/';
        
        $this->bot_information = $this->getMe();
    }
}
