<?php
class Emprunt
{
    // Emprunts non rendus, avec le nombre de jours écoulés
    public static function enCours(): array
    {
        $sql = 'SELECT e.id, e.date_emprunt, l.titre, a.nom, a.prenom,
                       DATEDIFF(CURDATE(), e.date_emprunt) AS jours
                FROM emprunts e
                JOIN livres l ON l.id = e.livre_id
                JOIN adherents a ON a.id = e.adherent_id
                WHERE e.date_retour IS NULL
                ORDER BY e.date_emprunt ASC';
        return Database::get()->query($sql)->fetchAll();
    }

    // Livres qui ont encore au moins un exemplaire libre
    public static function livresDisponibles(): array
    {
        $sql = 'SELECT l.id, l.titre, l.auteur,
                       l.nb_exemplaires - (
                           SELECT COUNT(*) FROM emprunts e
                           WHERE e.livre_id = l.id AND e.date_retour IS NULL
                       ) AS disponibles
                FROM livres l
                HAVING disponibles > 0
                ORDER BY l.titre';
        return Database::get()->query($sql)->fetchAll();
    }

    public static function adherents(): array
    {
        return Database::get()
            ->query('SELECT id, nom, prenom, classe FROM adherents ORDER BY nom, prenom')
            ->fetchAll();
    }

    // Enregistre un emprunt. Retourne false si le livre n'a plus d'exemplaire.
    public static function create(int $livreId, int $adherentId): bool
    {
        $pdo = Database::get();
        $pdo->beginTransaction();
        try {
            $st = $pdo->prepare('SELECT nb_exemplaires FROM livres WHERE id = ? FOR UPDATE');
            $st->execute([$livreId]);
            $livre = $st->fetch();
            if (!$livre) {
                $pdo->rollBack();
                return false;
            }

            $st = $pdo->prepare(
                'SELECT COUNT(*) FROM emprunts WHERE livre_id = ? AND date_retour IS NULL'
            );
            $st->execute([$livreId]);
            $pris = (int) $st->fetchColumn();

            if ((int) $livre['nb_exemplaires'] - $pris <= 0) {
                $pdo->rollBack();
                return false;
            }

            $st = $pdo->prepare(
                'INSERT INTO emprunts (livre_id, adherent_id, date_emprunt) VALUES (?, ?, CURDATE())'
            );
            $st->execute([$livreId, $adherentId]);
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            return false;
        }
    }

    // Enregistre le retour (met la date du jour dans date_retour)
    public static function retourner(int $id): bool
    {
        $st = Database::get()->prepare(
            'UPDATE emprunts SET date_retour = CURDATE() WHERE id = ? AND date_retour IS NULL'
        );
        $st->execute([$id]);
        return $st->rowCount() > 0;
    }
}