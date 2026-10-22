
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (nom, email, password)
VALUES ('Bibliothécaire', 'admin@biblionet.ga', '$2y$10$E2htFcx2dQ7pLC3lShaiXuX98s9tPJAagtAEKaxa/KA1lCE/YQQ1O');

CREATE TABLE IF NOT EXISTS livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    auteur VARCHAR(150) NOT NULL,
    categorie VARCHAR(100),
    annee INT,
    nb_exemplaires INT NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS adherents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    classe VARCHAR(50),
    telephone VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livre_id INT NOT NULL,
    adherent_id INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE NULL,
    FOREIGN KEY (livre_id) REFERENCES livres(id),
    FOREIGN KEY (adherent_id) REFERENCES adherents(id)
);

INSERT INTO livres (titre, auteur, categorie, annee, nb_exemplaires) VALUES
('Le Petit Prince', 'Antoine de Saint-Exupéry', 'Jeunesse', 1943, 4),
('L''Étranger', 'Albert Camus', 'Roman', 1942, 3),
('Les Misérables', 'Victor Hugo', 'Roman', 1862, 2),
('Germinal', 'Émile Zola', 'Roman', 1885, 2),
('Une si longue lettre', 'Mariama Bâ', 'Roman', 1979, 3),
('L''Enfant noir', 'Camara Laye', 'Roman', 1953, 3),
('Une vie de boy', 'Ferdinand Oyono', 'Roman', 1956, 2),
('Les Soleils des indépendances', 'Ahmadou Kourouma', 'Roman', 1968, 2),
('Cahier d''un retour au pays natal', 'Aimé Césaire', 'Poésie', 1939, 1),
('Une brève histoire du temps', 'Stephen Hawking', 'Science', 1988, 2),
('Sapiens', 'Yuval Noah Harari', 'Histoire', 2011, 3),
('L''Alchimiste', 'Paulo Coelho', 'Roman', 1988, 4),
('Harry Potter à l''école des sorciers', 'J.K. Rowling', 'Jeunesse', 1997, 5),
('Clean Code', 'Robert C. Martin', 'Informatique', 2008, 2),
('Introduction à l''algorithmique', 'Thomas H. Cormen', 'Informatique', 2009, 2);