<?php
// Define Exception-Messages
define( 'NON_OPT_PARAM' , 'Non-optional parameter empty');

class User
{

    /**
     * Unique identifier for this user or bot
     *
     * @var int
     */
    public $id;

    /**
     * User's or bot's first name
     *
     * @var String
     */
    public $first_name;

    /**
     * User's or bot's last name
     *
     * @var String
     */
    public $last_name;

    /**
     * User's or bot's username
     *
     * @var String
     */
    public $username;

    /**
     * Constructor
     *
     * @param array decoded JSON-Array from the API
     * 
     * @return void constructor
     *
     * @throws Exception When non optional parameters are empty
     */
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
    /**
     * Unique message identifier
     *
     * @var int 
     */
    public $message_id;

    /**
     * Sender, can be empty for messages sent to channels
     * OPTIONAL
     *
     * @var User
     */
    public $from;

    /**
     * Date the message was sent in Unix time
     *
     * @var int
     */
    public $date;

    /**
     * Conversation the message belongs to
     *
     * @var Chat
     */
    public $chat;

    /**
     * For forwarded messages, sender of the original message
     * OPTIONAL
     *
     * @var User
     */
    public $forward_from;

    /**
     * For forwarded messages, date the original message was sent
     * int Unix time
     * OPTIONAL
     *
     * @var int
     */
    public $forware_date;

    /**
     * For replies, the original message. Note that the Message object
     * in tis field will not contain further reply_to_message fields
     * even if it itself is a reply
     * OPTIONAL
     *
     * @var Message
     */
    public $reply_to_message;

    /**
     * For text messages, the actual UFT-8 text of the message
     * OPTIONAL
     *
     * @var String
     */
    public $text;

    /**
     * Message is an audio file, information about the file
     * OPTIONAL 
     *
     * @var Audio
     */ 
    public $audio; 

    /**
     * Message is an general file, information about the file
     * OPTIONAL
     *
     * @var Document
     */
    public $document;

    /**
     * Message is a photo, available sizes of the photo
     * OPTIONAL
     *
     * @var PhotoSize[]
     */
    public $photo;

    /**
     * Message is a sticker information about the sticker
     * OPTIONAL
     *
     * @var Sticker
     */
    public $sticker;

    /**
     * Message is a video, information about the video
     * OPTIONAL
     *
     * @var Video
     */
    public $video;

    /**
     * Message is a voice message, information about the file
     * OPTIONAL
     *
     * @var Voice
     */
    public $voice;

    /**
     * Caption of the photo or video, 0-200 characters
     * OPTIONAL
     *
     * @var String
     */
    public $caption;

    /**
     * Message is a shared contact, information about the
     * contact
     * OPTIONAL
     *
     * @var Contact
     */
    public $contact;

    /**
     * Message is a shared location, information about the location
     * OPTIONAL
     *
     * @var Location
     */
    public $location;

    /**
     * A new member was added to the group, information about them (this
     * member may be the bot itself
     * OPTIONAL
     *
     * @var User
     */
    public $new_chat_participant;

    /**
     * A member was removed from the group, information about them (this 
     * member may be the bot itself
     * OPTIONAL
     *
     * @var User
     */
    public $left_chat_participant;

    /**
     * A chat title was changed to this value
     * OPTIONAL
     *
     * @var String
     */
    public $new_chat_title;

    /**
     * A chat photo was change to this value
     * OPTIONAL
     *
     * @var PhotoSize[]
     */
    public $new_chat_photo;

    /**
     * Service message: the chat photo was deleted
     * OPTIONAL
     *
     * @var bool true
     */
    public $delete_chat_photo;

    /**
     * Servce message: the group has been created
     * OPTIONAL
     *
     * @var bool true
     */
    public $group_chat_created;

    /**
     * Service message: the supergroup has been created
     * OPTIONAL
     *
     * @var bool true
     */
    public $supergroup_chat_created;

    /**
     * Service message: the channel has been created
     * OPTIONAL
     *
     * @var bool true
     */
    public $channel_chat_created;

    /**
     * The group has been migrated to a supergroup with the specified
     * identifier, not exceeding 1e14 by absolute value
     * OPTIONAL
     *
     * @var int
     */
    public $migrate_to_chat_id;

    /**
     * The supergroup has been migrated from a group with the specified
     * identifier, not exceeding 1e13 by absolute value
     * OPTIONAL
     *
     * @var int
     */
    public $migrate_from_chat_id;

    public function __construct( $params )
    {
        if( empty( $params["message_id"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->message_id = $params["message_id"];
        }

        if( !empty( $params["from"] ) )
        {
            $this->from = new User( $params["from"] );
        }

        if( empty( $params["date"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->date = $params["date"];
        }

        if( empty( $params["chat"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->chat = new Chat( $params["chat"] );
        }

        if( !empty( $params["forward_from"] ) )
        {
            $this->forward_from = new User( $params["forward_from"] );
        }

        if( !empty( $params["forward_date"] ) )
        {
            $this->forward_date = $params["forward_date"];
        }

        if( !empty( $params["reply_to_message"] ) )
        {
            $this->reply_to_message = new Message( $params["reply_to_message"] );
        }

        if( !empty( $params["text"] ) )
        {
            $this->text = $params["text"];
        }

        if( !empty( $params["audio"] ) )
        {
            $this->audio = new Audio( $params["audio"] );
        }

        if( !empty( $params["document"] ) )
        {
            $this->document = new Document( $params["document"] );
        }

        if( !empty( $params["photo"] ) )
        {
            foreach( $params["photo"] as $pid => $photo )
            {
                $this->photo[$pid] = new PhotoSize( $photo );
            }
        }

        if( !empty( $params["sticker"] ) )
        {
            $this->sticker = new Sticker( $params["sticker"] );
        }

        if( !empty( $params["video"] ) )
        {
            $this->video = new Video( $params["video"] );
        }

        if( !empty( $params["voice"] ) )
        {
            $this->voice = new Voice( $params["voice"] );
        }

        if( !empty( $params["caption"] ) )
        {
            $this->caption = $params["caption"];
        }

        if( !empty( $params["contact"] ) )
        {
            $this->contact = new Contact( $params["contact"] );
        }

        if( !empty( $params["location"] ) )
        {
            $this->location = new Location( $params["location"] );
        }

        if( !empty( $params["new_chat_participant"] ) )
        {
            $this->new_chat_participant = new User( $params["new_chat_participant"] );
        }

        if( !empty( $params["left_chat_participant"] ) )
        {
            $this->left_chat_participant = new User( $params["left_chat_participant"] );
        }

        if( !empty( $params["new_chat_title"] ) )
        {
            $this->new_chat_title = $params["new_chat_title"];
        }

        if( !empty( $params["new_chat_photo"] ) )
        {
            foreach( $params["new_chat_photo"] as $pid => $photo )
            {
                $this->new_chat_photo[$pid] = new PhotoSize( $photo );
            }
        }

        if( !empty( $params["delete_chat_photo"] ) )
        {
            $this->delete_chat_photo = $params["delete_chat_photo"];
        }

        if( !empty( $params["group_chat_created"] ) )
        {
            $this->group_chat_created = $params["group_chat_created"];
        }

        if( !empty( $params["supergroup_chat_created"] ) )
        {
            $this->supergroup_chat_created = $params["supergroup_chat_created"];
        }

        if( !empty( $params["channel_chat_created"] ) )
        {
            $this->channel_chat_created = $params["channel_chat_created"];
        }

        if( !empty( $params["migrate_to_chat_id"] ) )
        {
            $this->migrate_to_chat_id = $params["migrate_to_chat_id"];
        }

        if( !empty( $params["migrate_from_chat_id"] ) )
        {
            $this->migrate_from_chat_id = $params["migrate_from_chat_id"];
        }
    }
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

class Audio
{
    // Unique identifier for this file
    public $file_id;
    // Duration of the audio in seconds as defined by sender
    public $duration;
    // OPTIONAL Performer of the audio as defined by sender or by audio tags
    public $performer;
    // OPTIONAL Title of the audio as defiend by sender or by audio tags
    public $title;
    // OPTIONAL MIME type of the file as defined by sender
    public $mime_type;
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

        if( empty( $params["duration"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->duration = $params["duration"];
        }

        if( !empty( $params["performer"] ) )
        {
            $this->performer = $params["performer"];
        }

        if( !empty( $params["title"] ) )
        {
            $this->title = $params["title"];
        }

        if( !empty( $params["mime_type"] ) )
        {
            $this->mime_type = $params["mime_type"];
        }

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $params["file_size"];
        }
    }
}

class Document
{
    // Unique file identifier
    public $file_id;
    // OPTIONAL Document thumbnail as defined by sender
    public $thumb;
    // OPTIONAL Original filename as defined by sender
    public $file_name;
    // OPTIONAL MIME type of the file as defined by sender
    public $mime_type;
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

        if( !empty( $params["thumb"] ) )
        {
            $this->thumb = new PhotoSize( $params["thumb"] );
        }

        if( !empty( $params["file_name"] ) )
        {
            $this->file_name = $params["file_name"];
        }

        if( !empty( $params["mime_type"] ) )
        {
            $this->mime_type = $params["mime_type"];
        }

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $params["file_size"];
        }
    }
}

class Sticker
{
    // Unique identifier for this file
    public $file_id;
    // Sticker width
    public $width;
    // Sticker height
    public $height;
    // OPTIONAL Sticker thumbnail in .webp or .jpg format
    public $thumb;
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

        if( !empty( $params["thumb"] ) )
        {
            $this->thumb = new PhotoSize( $params["thumb"] );
        }

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $params["file_size"];
        }
    }
}

class Video
{
    // Unique identifier for this file
    public $file_id;
    // Video width as defined by sender
    public $width;
    // Video height as defined by sender
    public $height;
    // Duration of the vieo in seconds as defined by sender
    public $duration;
    // OPTIONAL Video thumbnail
    public $thumb;
    // OPTIONAL Mime type of a file as defined by sender
    public $mime_type;
    // OPTIONAL file size
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
            $this->height = $param["height"];
        }

        if( empty( $params["duration"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->duration = $param["duration"];
        }

        if( !empty( $params["thumb"] ) )
        {
            $this->thumb = new PhotoSize( $param["thumb"] );
        }

        if( !empty( $params["mime_type"] ) )
        {
            $this->mime_type = $param["mime_type"];
        }

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $param["file_size"];
        }
    }
}

class Voice
{
    // Unique identifier for this file
    public $file_id;
    // Duration of the audio in seconds as defined by sender
    public $duration;
    // OPTIONAL MIME type of the file as defined by sender
    public $mime_type;
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

        if( empty( $params["duration"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->duration = $params["duration"];
        }

        if( !empty( $params["mime_type"] ) )
        {
            $this->mime_type = $params["mime_type"];
        }

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $params["file_size"];
        }
    }
}

class Contact
{
    // Contacts phone number
    public $phone_number;
    // Contacts first name
    public $first_name;
    // OPTIONAL Contacts last name
    public $last_name;
    // OPTIONAL Contacts user identifier in Telegram
    public $user_id;

    public function __construct( $params )
    {
        if( empty( $params["phone_number"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->phone_number = $params["phone_number"];
        }

        if( empty( $params["first_name"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->first_name = $params["first_name"];
        }

        if( !empty( $params["last_name"] ) )
        {
            $this->last_name = $params["last_name"];
        }

        if( !empty( $params["user_id"] ) )
        {
            $this->user_id = $params["user_id"];
        }
    }
}

class Location
{
    // Longitude as defined by sender
    public $longitude;
    // Latitude as defined by sender
    public $latitude;

    public function __construct( $params )
    {
        if( empty( $params["longitude"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->longitude = $params["longitude"];
        }

        if( empty( $params["latitude"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->latitude = $params["latitude"];
        }
    }
}

class UserProfilePhotos
{
    // Total number of profile pictures the target user has
    public $total_count;
    // Reuqest profile pictures 
    public $photos;

    public function __construct( $params )
    {
        if( empty( $params["total_count"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->total_count = $params["total_count"];
        }

        if( empty( $params["photos"] ) )
        {
            foreach( $params["photos"] AS $i => $p )
            {
                foreach( $p AS $ii => $pp )
                {
                    if( empty( $pp ) )
                    {
                        throw new Exception( NON_OPT_PARAM );
                    }
                    else
                    {
                        $this->photos[$i][$ii] = new PhotoSize( $pp );
                    }
                }
            }
        }
    }
}

class File
{
    // Unique identifier for this file
    public $file_id;
    // OPTIONAL File size, if known
    public $file_size;
    // OPTIONAL File path
    public $file_path;

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

        if( !empty( $params["file_size"] ) )
        {
            $this->file_size = $params["file_size"];
        }

        if( !empty( $params["file_path"] ) )
        {
            $this->file_path = $params["file_path"];
        }
    }
}

class ReplyKeyboardMarkup
{
    // Array of button rows, each represented by an Array of Strings
    public $keyboard;
    // OPTIONAL Requests clients to resize the keyboard vertically
    // for optimal fit (e.g., make the keyboard smaller if there
    // are just two rows of buttons). Defaults to false, in which
    // case the custom keyboard is always of the same height as the
    // app's standard keyboard
    public $resize_keyboard;
    // OPTIONAL Requests clients to hide the keyboard as soon as
    // its been used. Default to false
    public $one_time_keyboard;
    // OPTIONAL Requests clients to hide the keyboard as soon as
    // it's been used. Defaults to false
    public $selective;
    // OPTIONAL Use this parameter if you want to show the keyboard
    // to specific users only. Targets: 1) uses that are @ mentioned
    // in the text of the Message object; 2) if the bot's message
    // is a reply (has reply_to_message_id), sender of the
    // original message.

    public function __construct( $params )
    {
        if( empty( $params["keyboard"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->keyboard = $params["keyboard"];
        }

        if( !empty( $params["resize_keyboard"] ) )
        {
            $this->resize_keyboard = $params["resize_keyboard"];
        }

        if( !empty( $params["one_time_keyboard"] ) )
        {
            $this->one_time_keyboard = $params["one_time_keyboard"];
        }

        if( !empty( $params["selective"] ) )
        {
            $this->selective = $params["selective"];
        }
    }
}

class ReplyKeyboardHide
{
    // Requests clients to hide the custom keyboard
    public $hide_keyboard;
    // OPTIONAL Use this parameter if you want to hide keyboard
    // for specific users only. Targets: 1) users that are
    // @mentioned in the text of the Message object; 2) if the
    // bot's message is a reply (has reply_to_message_id), sender
    // of the original message
    public $selective;

    public function __construct( $params )
    {
        if( empty( $params["hide_keyboard"] ) )
        {
            throw new Exception( NON_OPT_PARAM );
        }
        else
        {
            $this->hide_keyboard = $params["hide_keyboard"];
        }
    }
}

?>
