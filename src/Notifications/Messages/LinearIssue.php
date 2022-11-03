<?php

namespace LaravelLinear\Notifications\Messages;

class LinearIssue
{
    protected $title;

    protected $message;

    protected $submitter;

    protected $attachments = [];

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function submitter($submitter)
    {
        $this->submitter = $submitter;

        return $this;
    }

    public function getSubmitter()
    {
        return $this->submitter;
    }

    public function attachment($path)
    {
        $this->attachments[] = $path;

        return $this;
    }

    public function getAttachments()
    {
        return collect($this->attachments);
    }
}
