<?php


namespace antonyz89\fcm;

use JsonSerializable;

class Notification implements JsonSerializable
{
    private $title;
    private $body;
    private $badge;
    private $icon;
    private $color;
    private $sound;
    private $clickAction;
    private $tag;
    private $image;

    public function __construct($title, $body, $image = '')
    {
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
    }

    /**
     * android only: notification title (also works for ios watches)
     *
     * @param string $title
     *
     * @return static
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * android/ios: the body text is the main content of the notification
     *
     * @param string $body
     *
     * @return static
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * iOS only: will add smal red bubbles indicating the number of notifications to your apps icon
     *
     * @param integer $badge
     *
     * @return static
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
        return $this;
    }

    /**
     * android only: set the name of your drawable resource as string
     *
     * @param string $icon the drawable name without .xml
     *
     * @return static
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * android only: background color of the notification icon when showing details on notifications
     *
     * @param string $color in #rrggbb format
     *
     * @return static
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * android/ios: what should happen upon notification click. when empty on android the default activity
     * will be launched passing any payload to an intent.
     *
     * @param string $actionName on android: intent name, on ios: category in apns payload
     *
     * @return static
     */
    public function setClickAction($actionName)
    {
        $this->clickAction = $actionName;
        return $this;
    }

    /**
     * android only: when set notification will replace prior notifications from the same app with the same
     * tag.
     *
     * @param string $tag
     *
     * @return static
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * android/ios: can be default or a filename of a sound resource bundled in the app.
     * @see https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
     *
     * @param string $sound a sounds filename
     *
     * @return static
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
        return $this;
    }

    public function jsonSerialize()
    {
        $jsonData = [];

        if ($this->title) {
            $jsonData['title'] = $this->title;
        }

        $jsonData['body'] = $this->body;

        if ($this->badge) {
            $jsonData['badge'] = $this->badge;
        }
        if ($this->icon) {
            $jsonData['icon'] = $this->icon;
        }
        if ($this->clickAction) {
            $jsonData['click_action'] = $this->clickAction;
        }
        if ($this->sound) {
            $jsonData['sound'] = $this->sound;
        }
        if ($this->color) {
            $jsonData['color'] = $this->color;
        }
        if ($this->tag) {
            $jsonData['tag'] = $this->tag;
        }
        if ($this->image) {
            $jsonData['image'] = $this->image;
        }

        return $jsonData;
    }
}
