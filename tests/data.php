<?php

declare(strict_types=1);
/** @noinspection ALL */
class PhoneNumber
{
    public string $number = '+49301234567';
}

class ContactInformation
{
    public function getPhoneNumbers(): array
    {
        return [
            new PhoneNumber(),
        ];
    }
}

class Person
{
    public function getInfo($key): ?ContactInformation
    {
        if ('contact' === $key) {
            return new ContactInformation();
        }

        return null;
    }
}

return [
    'janitor' => new Person(),
];
