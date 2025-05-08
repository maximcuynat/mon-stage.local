-- Création de la base de données
CREATE DATABASE IF NOT EXISTS internships;
USE internships;

-- Création de la table "Entreprises"
CREATE TABLE IF NOT EXISTS Entreprises (
    ID INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50),
    Adresse VARCHAR(100),
    Ville VARCHAR(50),
    Code_Postal VARCHAR(10),
    Pays VARCHAR(50),
    Telephone VARCHAR(20),
    Site_Web VARCHAR(100),
    Email VARCHAR(100),
    Liens_Offre VARCHAR(255),
    PRIMARY KEY (ID)
);

-- Création de la table "Contacts"
CREATE TABLE IF NOT EXISTS Contacts (
    ID INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Email VARCHAR(50),
    Telephone VARCHAR(20),
    Poste VARCHAR(50),
    ID_Entreprise INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Entreprise) REFERENCES Entreprises(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Création de la table "Stages"
CREATE TABLE IF NOT EXISTS Stages (
    ID INT NOT NULL AUTO_INCREMENT,
    Lien_Offre VARCHAR(100),
    Description TEXT,
    Date_Postulation DATE,
    ID_Entreprise INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Entreprise) REFERENCES Entreprises(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Création de la table "Statuts"
CREATE TABLE IF NOT EXISTS Statuts (
    ID INT NOT NULL AUTO_INCREMENT,
    Statut VARCHAR(50),
    PRIMARY KEY (ID)
);

-- Insertion des valeurs par défaut dans la table Statuts
INSERT INTO Statuts (Statut) VALUES ('En attente'), ('En cours de traitement'), ('Entretien'), ('Accepté'), ('Refusé');

-- Création de la table "Candidatures"
CREATE TABLE IF NOT EXISTS Candidatures (
    ID INT NOT NULL AUTO_INCREMENT,
    ID_Stage INT,
    ID_Statut INT,
    Date_Candidature DATE,
    Commentaires TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Stage) REFERENCES Stages(ID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ID_Statut) REFERENCES Statuts(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Vérification des modifications
SHOW TABLES;
DESCRIBE Entreprises;
DESCRIBE Contacts;
DESCRIBE Stages;
DESCRIBE Statuts;
DESCRIBE Candidatures;