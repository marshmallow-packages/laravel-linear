<?php

namespace LaravelLinear\Notifications\Messages;

use Illuminate\Database\Eloquent\Model;

class LinearIssue
{
    protected $label;

    protected $title;

    protected $message;

    protected $submitter;

    protected $issue_model;

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

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        $parts = preg_split("/\r\n|\n|\r/", $this->message);

        return implode('\\n', $parts);
    }

    public function submitter($submitter)
    {
        $this->submitter = $submitter;

        return $this;
    }

    public function getSubmitter()
    {
        return $this->submitter ?? __('Anonymous');
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

    public function issueModel(Model $issue_model)
    {
        $this->issue_model = $issue_model;

        return $this;
    }

    public function getIssueModel()
    {
        return $this->issue_model;
    }
}
