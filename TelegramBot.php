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
     * Information about the running bot
     *
     * @var User
     */
    public $bot_information;

    /**
     * curl instance
     *
     * @var curl
     */
    protected $curl;

    /**
     * Array with supported attachments
     *
     * @var array
     */
    protected $attachments = array( 'audio' , 'document' , 'photo' , 'sticker' , 'video' );

    public function __construct( $api_token )
    {
        if( empty( $api_token ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }

        $this->api_token = $api_token;
        $this->url = 'https://api.telegram.org/bot'.$this->api_token.'/';
        $this->curl = curl_init();
        
        $this->bot_information = $this->getMe();
    }

    /**
     * A simple method for testing your bot's auth token. Requires no
     * parameters.
     *
     * @return User The bot itself
     */
    public function getMe()
    {
        return new User( $this->call( 'getMe' ) );
    }

    public function call( $method , $data = NULL )
    {
        $options = array(
            CURLOPT_URL => $this->url . $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => null,
            CURLOPT_POSTFIELDS => null
        );

        if( !empty( $data ) )
        {
            foreach( $this->attachments as $attachment )
            {
                if( !empty( $data[$attachment] ) )
                {
                    $data[$attachment] = $this->getCurlFile( $data[$attachment] );
                    break;
                }
            }

            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        curl_setopt_array( $this->curl , $options ); 

        $response = curl_exec( $this->curl );
        $response = json_decode( $response , true );

        if( empty( $response ) OR $response["ok"] != true )
        {
            throw new Exception( $response['description'] , $response['error_code'] );
        }
        else
        {
            return $response['result'];
        }
    }

    protected function getCurlFile( $file_path )
    {
        $real_path = realpath( $path );

        if( empty( $real_path ) )
        {
            throw new Exception( 'File not found' );
        }

        if( !class_exists('CURLFile') )
        {
            throw new Exception( 'Please install php curl' );
        }
        else
        {
            return new CURLFile( $real_path );
        }
    }
}
