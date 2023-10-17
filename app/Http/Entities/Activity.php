<?php

namespace App\Http\Entities;

class Activity
{
    private string $activity = '';

    private string $type = '';

    private int $participants = 0;

    private int $price = 0;

    private string $link = '';

    private string $key = '';

    private int $accessibility = 0;

    public function getActivity(): string
    {
        return $this->activity;
    }

    public function setActivity(string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getParticipants(): int
    {
        return $this->participants;
    }

    public function setParticipants(int $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getAccessibility(): int
    {
        return $this->accessibility;
    }

    public function setAccessibility(int $accessibility): self
    {
        $this->accessibility = $accessibility;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'activity' => $this->activity,
            'type' => $this->type,
            'participants' => $this->participants,
            'price' => $this->price,
            'link' => $this->link,
            'key' => $this->key,
            'accessibility' => $this->accessibility,
        ];
    }
}
