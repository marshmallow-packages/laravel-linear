<?php

namespace LaravelLinear\Notifications\Messages;

use Illuminate\Database\Eloquent\Model;

class LinearIssue
{
    protected $label;

    protected $title;

    protected $message;

    protected $submitter;

    protected $project_id;

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

    public function projectId(string $project_id): self
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getProjectId(): ?string
    {
        return $this->project_id;
    }

    public function label($label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage(): string
    {
        $parts = preg_split("/\r\n|\n|\r/", $this->message);

        return implode('\\n', $parts);
    }

    public function submitter($submitter): self
    {
        $this->submitter = $submitter;

        return $this;
    }

    public function getSubmitter(): string
    {
        return $this->submitter ?? __('Anonymous');
    }

    public function attachment($path): self
    {
        $this->attachments[] = $path;

        return $this;
    }

    public function getAttachments()
    {
        return collect($this->attachments);
    }

    public function issueModel(Model $issue_model): self
    {
        $this->issue_model = $issue_model;

        return $this;
    }

    public function getIssueModel(): ?Model
    {
        return $this->issue_model;
    }
}
