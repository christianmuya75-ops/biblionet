<?php
class Livre
{
    public static function all(): array
    {
        return Database::get()->query('SELECT * FROM livres ORDER BY titre')->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $st = Database::get()->prepare('SELECT * FROM livres WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch() ?: null;
    }

    public static function create(array $d): void
    {
        $st = Database::get()->prepare(
            'INSERT INTO livres (titre, auteur, categorie, annee, nb_exemplaires) VALUES (?, ?, ?, ?, ?)'
        );
        $st->execute([$d['titre'], $d['auteur'], $d['categorie'], $d['annee'], $d['nb_exemplaires']]);
    }

    public static function update(int $id, array $d): void
    {
        $st = Database::get()->prepare(
            'UPDATE livres SET titre = ?, auteur = ?, categorie = ?, annee = ?, nb_exemplaires = ? WHERE id = ?'
        );
        $st->execute([$d['titre'], $d['auteur'], $d['categorie'], $d['annee'], $d['nb_exemplaires'], $id]);
    }

    public static function delete(int $id): void
    {
        $st = Database::get()->prepare('DELETE FROM livres WHERE id = ?');
        $st->execute([$id]);
    }

    // Catalogue public : exemplaires disponibles = nb_exemplaires - emprunts sans date_retour
    public static function catalogue(string $q = ''): array
    {
        $sql = 'SELECT l.*, l.nb_exemplaires - (
                    SELECT COUNT(*) FROM emprunts e
                    WHERE e.livre_id = l.id AND e.date_retour IS NULL
                ) AS disponibles
                FROM livres l';
        $params = [];
        if ($q !== '') {
            $sql .= ' WHERE l.titre LIKE ? OR l.auteur LIKE ?';
            $params = ["%$q%", "%$q%"];
        }
        $sql .= ' ORDER BY l.titre';
        $st = Database::get()->prepare($sql);
        $st->execute($params);
        return $st->fetchAll();
    }
}