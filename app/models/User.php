<?php
class User
{
    public static function findByEmail(string $email): ?array
    {
        $st = Database::get()->prepare('SELECT * FROM users WHERE email = ?');
        $st->execute([$email]);
        return $st->fetch() ?: null;
    }
}