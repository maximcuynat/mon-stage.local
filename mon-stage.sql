-- Création de la table "Entreprises"
CREATE TABLE Entreprises (
    ID INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50),
    Adresse VARCHAR(100),
    Ville VARCHAR(50),
    Code_Postal VARCHAR(10),
    Pays VARCHAR(50),
    Telephone VARCHAR(20),
    Site_Web VARCHAR(100),
    PRIMARY KEY (ID)
);

-- Création de la table "Contacts"
CREATE TABLE Contacts (
    ID INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Email VARCHAR(50),
    Telephone VARCHAR(20),
    Poste_Actuelle VARCHAR(50),
    ID_Entreprise INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Entreprise) REFERENCES Entreprises(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Création de la table "Stages"
CREATE TABLE Stages (
    Id INT NOT NULL AUTO_INCREMENT,
    Nom_Entreprise VARCHAR(50),
    Lien_Offre VARCHAR(100),
    Description TEXT,
    Date_Postulation DATE,
    ID_Entreprise INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Entreprise) REFERENCES Entreprises(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Statuts (
    ID INT NOT NULL AUTO_INCREMENT,
    Statut VARCHAR(50),
    PRIMARY KEY (ID)
);
INSERT INTO Statuts (Statut) VALUES ('En attente'), ('En cours de traitement'), ('Accepté'), ('Refusé');

-- Création de la table "Candidatures"
CREATE TABLE Candidatures (
    ID INT NOT NULL AUTO_INCREMENT,
    ID_Stage INT,
    ID_Statut INT,
    Date_Candidature DATE,
    Commentaires TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_Stage) REFERENCES Stages(ID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ID_Statut) REFERENCES Statuts(ID) ON DELETE CASCADE ON UPDATE CASCADE
);