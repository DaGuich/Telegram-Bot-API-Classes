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

    /**
     * Use this method to send text messages.
     * 
     * @param mixed chat_id Unique identifier for the target chat or username
     * of the target chat
     * @param string text Text of the message to be sent
     * @param string parse_mode Send Markdown if you want Telegram apps to show
     * bold, italic and inline URLs in your bot's message
     * @param bool disable_web_page_preview Disables link previews for linsk
     * ins this message
     * @param int reply_to_message_id If the message is a reply, ID of he
     * original message
     * @param mixed Additional interace options. A JSON-serialized object for
     * a custom reply keyboard, instructions to hide keyboard or to force a
     * reply from the user
     *
     * @return Message this message
     */
    public function sendMessage(
        $chat_id ,
        $text ,
        $parse_mode = NULL,
        $disable_web_page_preview = NULL ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();
        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $text ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["text"] = $text;
        }

        if( !empty( $parse_mode ) )
        {
            $data["parse_mode"] = $parse_mode;
        }

        if( !empty( $disable_web_page_preview ) )
        {
            $data["disable_web_page_preview"] = $disable_web_page_preview;
        }

        if( !empty( $reply_to_message ) )
        {
            $data["reply_to_message"] = $reply_to_message;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }
        
        return new Message( $this->call( 'sendMessage' , $data ) );
    }

    /**
     * Use this method to forward messages of any kind. On success, the sent
     * Messge is returned
     *
     * @return Message The sent message
     * @param mixed chat_id Unique identifier for the target chat or username of the
     * target channel (in the format @channelusername)
     * @param mixed from_chat_id Unique identifier for the chat where the
     * original message was sent (or channel username in the format
     * @channelusername)
     * @param int message_id Unique message identifier
     */
    public function forwardMessage( 
        $chat_id,
        $from_chat_id,
        $message_id
    )
    {
        $data = array();

        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $from_chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["from_chat_id"] = $from_chat_id;
        }

        if( empty( $message_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["message_id"] = $message_id;
        }

        return new Message( $this->call( 'forwardMessage' , $data ) );
    }

    /**
     * Use this method to send photos
     *
     * @param mixed chat_id 
     * @param mixed photo InputFile or String
     * @param String caption
     * @param int reply_to_message_id
     * @param mixed reply_markup
     *
     * @return Message the sent message
     */
    public function sendPhoto(
        $chat_id ,
        $photo ,
        $caption = NULL ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();

        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $photo ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["photo"] = $photo;
        }

        if( !empty( $caption ) )
        {
            $data["caption"] = $caption;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendPhoto' , $data ) );
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to
     * display them in the music player. Your audio must be in the .mpe ormat.
     * On success, the sent Message is returned. Bots can currently send audio
     * files up to 50MB in size, this limit may be changed in the future.
     *
     * For backward compatibility, when the fields title and performer are both
     * empty and the mime-type of the file to be sent is not audio/mpeg, the
     * file will be sent as a playable voice message. For this to work, the
     * audio must be in an .ogg file encoded with OPUS. This behavior will be
     * phased out in the future. For sending voice messages, use the sendVoice
     * method instead.
     *
     * @param mixed chat_id
     * @param mixed audio
     * @param int duration Duration of the audio in seconds
     * @param String performer
     * @param String title
     * @param int reply_to_message_id
     * @param mixed reply_markup
     *
     * @return Message the sent message
     */
    public function sendAudio(
        $chat_id ,
        $audio ,
        $duration = NULL ,
        $performer = NULL ,
        $title = NULL ,
        $reply_to_message = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();

        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $audio ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["audio"] = $audio;
        }

        if( !empty( $duration ) )
        {
            $data["duration"] = $duration;
        }
        
        if( !empty( $performer ) )
        {
            $data["performer"] = $performer;
        }

        if( !empty( $title ) )
        {
            $data["title"] = $title;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendAudio' , $data ) );
    }

    /**
     * Use this method to send general files. On success, the sent Message is
     * returned. Bots can currently send files of any type of up to 50MB in
     * size, this limit may be changed in the future.
     *
     * @param mixed chat_id
     * @param mixed document
     * @param int reply_to_message_id
     * @param mixed reply_markup 
     */
    public function sendDocument(
        $chat_id ,
        $document ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();

        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $document ) ) 
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["document"] = $document;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendDocument' , $data ) );
    }

    /**
     * Use this method to send .webp stickers.
     *
     * @param mixed chat_id
     * @param mixed Sticker
     * @param int reply_to_message_id
     * @param mixed reply_markup 
     *
     * @return Message The sent message
     */
    public function sendSticker(
        $chat_id ,
        $sticker ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();
        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $sticker ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["sticker"] = $sticker;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendSticker' , $data ) );
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos
     * (other formats my be sent as Document).
     * Bots can currenly send video files of up to 50 MB in size, this limit
     * may be changed in the future.
     *
     * @param mixed chat_id
     * @param mixed video
     * @param int duration
     * @param String caption
     * @param int reply_to_message_id
     * @param mixed reply_markup
     *
     * @return Message the sent message
     */
    public function sendVideo(
        $chat_id ,
        $video ,
        $duration = NULL ,
        $caption = NULL ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();
        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $video ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["video"] = $video;
        }

        if( !empty( $duration ) )
        {
            $data["duration"] = $duration;
        }

        if( !empty( $caption ) )
        {
            $data["caption"] = $caption;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendVideo' , $data ) );
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to
     * display the file as a playable voice message. For this to work your
     * audio must be in an .ogg file encoded with OPUS
     *
     * @param mixed chat_id
     * @param mixed voice
     * @param int duration
     * @param int reply_to_message_id
     * @param mixed reply_markup
     *
     * @return Message The sent message
     */
    public function sendVoice(
        $chat_id ,
        $voice ,
        $duration = NULL ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();
        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $voice ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["voice"] = $voice;
        }

        if( !empty( $duration ) )
        {
            $data["duration"] = $duration;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendVoice' , $data ) );
    }

    /**
     * Use this function to point on the map
     *
     * @param mixed chat_id
     * @param float latitude
     * @param float longitude
     * @param int reply_to_message_id
     * @param mixed reply_markup
     *
     * @return Message The sent message
     */
    public function sendLocation(
        $chat_id ,
        $latitude ,
        $longitude ,
        $reply_to_message_id = NULL ,
        $reply_markup = NULL
    )
    {
        $data = array();
        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $latitude ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["latitude"] = $latitude;
        }

        if( empty( $longitude ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["longitude"] = $longitude;
        }

        if( !empty( $reply_to_message_id ) )
        {
            $data["reply_to_message_id"] = $reply_to_message_id;
        }

        if( !empty( $reply_markup ) )
        {
            $data["reply_markup"] = $reply_markup;
        }

        return new Message( $this->call( 'sendLocation' , $data ) );
    }

    /**
     * Use this method when you need to tell the user that something is
     * happening on the bot's side. The status is set for 5seconds or less
     * (when a message arrives from your bot, Telegram clients cler its typing
     * status).
     *
     * @param mixed chat_id
     * @param String action
     *
     * @return bool
     */
    public function sendChatAction(
        $chat_id ,
        $action 
    )
    {
        $data = array();
        if( empty( $chat_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $data["chat_id"] = $chat_id;
        }

        if( empty( $action ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            switch( $action )
            {
            case 'typing':
            case 'upload_photo':
            case 'record_video':
            case 'upload_video':
            case 'record_audio':
            case 'upload_audio':
            case 'upload_document':
            case 'find_location':
                $data["action"] = $action;
                break;
            default:
                return false;
            }
        }

        return $this->call( 'sendChatAction' , $data );
    }

    /**
     * Use this method to get basic info about a file and prepare it for
     * downloading. For the moment, bots can download files of up to 20MB in
     * size. It is guaranteed that the link will be valid for at least 1 hoar.
     * When the link expires, a new one can be requested by calling getFile
     * again
     *
     * @param String file_id
     *
     * @return File
     */
    public function getFile( $file_id )
    {
        if( empty( $file_id ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            return new File( $this->call( 'getFile' , [ "file_id" => $file_id ] ) );
        }
    }

    /**
     * Use this method to receive incoming updates using long polling. An Array
     * 
     * @param int offset
     * @param int limit Value between 1 and 100
     * @param int timeout
     *
     * @return Array of Updates
     */
    public function getUpdates(
        $offset = NULL ,
        $limit = NULL ,
        $timeout = NULL
    )
    {
        $data = array();
        if( !empty( $offset ) )
        {
            $data["offset"] = $offset;
        }

        if( !empty( $limit ) )
        {
            $data["limit"] = $limit;
        }

        if( !empty( $timeout ) )
        {
            $data["timeout"] = $timeout;
        }

        $responses = $this->call( 'getUpdates' , $data );

        $return = array();
        foreach( $responses as $response )
        {
            $return[] = new Update( $response );
        }

        return $return;
    }

    /**
     * Use this method to specify a url and receive incoming updates via an
     * outgoing webhook. Whenever there is an update for the bot, we will send
     * an HTTPS POST request to the specified url, containing a JSON-serialized
     * Update.
     *
     * @param String url
     * @param InputFile certificate
     */
    public function setWebhook(
        $url = NULL ,
        $certificate = NULL
    )
    {
        $data = array();
        if( !empty( $url ) )
        {
            $data["url"] = $url;
        }

        if( !empty( $certificate ) )
        {
            $data["certificate"] = $certificate;
        }

        return $this->call( 'setWebhook' , $data );
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
        $real_path = realpath( $file_path );

        if( empty( $real_path ) )
        {
            throw new Exception( 'File not found' );
            // TODO: reuse old file_id's?
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
