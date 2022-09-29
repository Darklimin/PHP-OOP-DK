<?php

namespace MyProject\Models;

//Neneaudojamas šis
class Advertisement
{
    public function __construct(
        private int    $id,
        private string $title,
        private string $text,
        private string $city,
        private string $phone,
    )
    {
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public static function fromArray(array $fields): Advertisement {
        return new Advertisement($fields['id'], $fields['title'], $fields['text'], $fields['city'], $fields['phone']);
    }


}