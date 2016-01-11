<?php

// Define Exception-Messages
define( 'NON_OPT_PARAM' , 'Non-optional parameter empty');

class User
{
    // Unique identifier for this user or bot
    public $id;
    // Users or bots first name
    public $first_name;
    // OPTIONAL Users or bots last name
    public $last_name;
    // OPTIONAL Users or bots username
    public $username;
    
    public function __construct( $params )
    {
        if( empty( $params["id"] ) )
        {
            throw new Exception(NON_OPT_PARAM);
        }
        else
        {
            $this->id = $params["id"];
        }

        if( empty( $params["first_name"] ) )
        {
            throw new Exception(NON_OPT_PARAM);
        }
        else
        {
            $this->first_name = $params["first_name"];
        }

        if( !empty( $params["last_name"] ) )
        {
            $this->last_name = $params["last_name"];
        }

        if( !empty( $params["username"] ) )
        {
            $this->username = $params["username"];
        }
    }
}

class Chat
{
    // Unique identifier for this chat, not exceeding 1e13 by absolute value
    public $id;
    // Type of chat can be either "private" , "group" , "supergroup" or
    // "channel"
    public $type;
    // OPTIONAL Title for channels and group chats
    public $title;
    // OPTIONAL Username, for private chats and channels if available
    public $username;
    // OPTIONAL First name of other party in a private chat
    public $first_name;
    // OPTIONAL Last name of other party in a private chat
    public $last_name;

    public function __construct( $params )
    {
        if( empty( $params["id"] ) )
        {
            throw new Exception( NON_OPT_PARAMS );
        }
        else
        {
            $this->id = $params["id"];
        }

        if( empty( $params["type"] ) )
        {
            throw new Exception( NON_OPT_PARAMS );
        }
        else
        {
            $this->type = $params["type"];
        }

        if( !empty( $params["title"] ) )
        {
            $this->title = $params["title"];
        }

        if( !empty( $params["username"] ) )
        {
            $this->username = $params["username"];
        }

        if( !empty( $params["first_name"] ) )
        {
            $this->first_name = $params["first_name"];
        }

        if( !empty( $params["last_name"] ) )
        {
            $this->last_name = $params["last_name"];
        }
    }
}

class Message
{

}

class PhotoSize
{
    // Unique identifier for this file
    public $file_id;
    // Photo width
    public $width;
    // Photo height
    public $height;
    // OPTIONAL File size
    public $file_size;
    
    public function __construct( $params )
    {
        if( empty( $params["file_id"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->file_id = $params["file_id"];
        }

        if( empty( $params["width"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->width = $params["width"];
        }

        if( empty( $params["height"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->height = $params["height"];
        }

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $params["file_size"];
        }
    }
}
?>
