<?php
// scripts/init_data.php
require_once __DIR__ . '/../src/Config/config.php';

// Connexion à la base de données
$pdo = new PDO(
    'mysql:host=' . CONFIG['db']['host'] . ';dbname=' . CONFIG['db']['name'] . ';charset=' . CONFIG['db']['charset'],
    CONFIG['db']['user'],
    CONFIG['db']['pass'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// Vérifier si les tables existent déjà
$tables = [
    'Statuts' => "CREATE TABLE Statuts (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Statut VARCHAR(50) NOT NULL
    )",
    'Entreprises' => "CREATE TABLE Entreprises (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(100) NOT NULL,
        Adresse TEXT,
        Ville VARCHAR(100),
        Code_Postal VARCHAR(20),
        Pays VARCHAR(100),
        Telephone VARCHAR(20),
        Site_Web VARCHAR(255),
        Email VARCHAR(255),
        Liens_Offre TEXT
    )",
    'Contacts' => "CREATE TABLE Contacts (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(100) NOT NULL,
        Prenom VARCHAR(100),
        Email VARCHAR(255),
        Telephone VARCHAR(20),
        Poste VARCHAR(100),
        ID_Entreprise INT,
        FOREIGN KEY (ID_Entreprise) REFERENCES Entreprises(ID) ON DELETE SET NULL
    )",
    'Stages' => "CREATE TABLE Stages (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Lien_Offre TEXT,
        Description TEXT NOT NULL,
        Date_Postulation DATE NOT NULL,
        ID_Entreprise INT,
        FOREIGN KEY (ID_Entreprise) REFERENCES Entreprises(ID) ON DELETE CASCADE
    )",
    'Candidatures' => "CREATE TABLE Candidatures (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        ID_Stage INT NOT NULL,
        ID_Statut INT NOT NULL,
        Date_Candidature DATE NOT NULL,
        Commentaires TEXT,
        FOREIGN KEY (ID_Stage) REFERENCES Stages(ID) ON DELETE CASCADE,
        FOREIGN KEY (ID_Statut) REFERENCES Statuts(ID) ON DELETE CASCADE
    )"
];

// Créer les tables si elles n'existent pas
foreach ($tables as $table => $sql) {
    $stmt = $pdo->prepare("SHOW TABLES LIKE '$table'");
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        $pdo->exec($sql);
        echo "Table $table créée.\n";
    } else {
        echo "Table $table existe déjà.\n";
    }
}

// Ajouter des statuts de candidature
$statuts = [
    'En attente',
    'Candidature envoyée',
    'Entretien',
    'Accepté',
    'Refusé'
];

// Vérifier si des statuts existent déjà
$stmt = $pdo->query("SELECT COUNT(*) FROM Statuts");
$count = $stmt->fetchColumn();

if ($count === 0) {
    foreach ($statuts as $statut) {
        $stmt = $pdo->prepare('INSERT INTO Statuts (Statut) VALUES (?)');
        $stmt->execute([$statut]);
    }
    echo "Statuts ajoutés.\n";
} else {
    echo "Des statuts existent déjà, aucun ajout.\n";
}

// Ajouter des entreprises de test
$entreprises = [
    [
        'Nom' => 'Microsoft France',
        'Adresse' => '39 Quai du Président Roosevelt',
        'Ville' => 'Issy-les-Moulineaux',
        'Code_Postal' => '92130',
        'Pays' => 'France',
        'Telephone' => '01 57 75 10 00',
        'Site_Web' => 'https://www.microsoft.com/fr-fr/',
        'Email' => 'contact@microsoft.fr'
    ],
    [
        'Nom' => 'Orange Business Services',
        'Adresse' => '1 Place des Droits de l\'Homme',
        'Ville' => 'Paris',
        'Code_Postal' => '75015',
        'Pays' => 'France',
        'Telephone' => '01 44 44 22 22',
        'Site_Web' => 'https://www.orange-business.com/',
        'Email' => 'contact.entreprise@orange.com'
    ],
    [
        'Nom' => 'Ubisoft',
        'Adresse' => '126 rue de Lagny',
        'Ville' => 'Montreuil',
        'Code_Postal' => '93100',
        'Pays' => 'France',
        'Telephone' => '01 48 18 50 00',
        'Site_Web' => 'https://www.ubisoft.com/fr-fr/',
        'Email' => 'info@ubisoft.com'
    ]
];

// Vérifier si des entreprises existent déjà
$stmt = $pdo->query("SELECT COUNT(*) FROM Entreprises");
$count = $stmt->fetchColumn();

if ($count === 0) {
    $entrepriseIds = [];

    foreach ($entreprises as $entreprise) {
        $stmt = $pdo->prepare('
            INSERT INTO Entreprises (
                Nom, Adresse, Ville, Code_Postal, Pays, Telephone, Site_Web, Email
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $entreprise['Nom'],
            $entreprise['Adresse'],
            $entreprise['Ville'],
            $entreprise['Code_Postal'],
            $entreprise['Pays'],
            $entreprise['Telephone'],
            $entreprise['Site_Web'],
            $entreprise['Email']
        ]);

        $entrepriseIds[$entreprise['Nom']] = $pdo->lastInsertId();
    }

    echo "Entreprises ajoutées.\n";

    // Ajouter des contacts pour chaque entreprise
    $contacts = [
        [
            'Nom' => 'Dupont',
            'Prenom' => 'Jean',
            'Email' => 'jean.dupont@microsoft.fr',
            'Telephone' => '01 57 75 10 01',
            'Poste' => 'Responsable RH',
            'Entreprise' => 'Microsoft France'
        ],
        [
            'Nom' => 'Martin',
            'Prenom' => 'Sophie',
            'Email' => 'sophie.martin@orange.com',
            'Telephone' => '01 44 44 22 33',
            'Poste' => 'Chargée de recrutement',
            'Entreprise' => 'Orange Business Services'
        ],
        [
            'Nom' => 'Lefevre',
            'Prenom' => 'Thomas',
            'Email' => 'thomas.lefevre@ubisoft.com',
            'Telephone' => '01 48 18 50 10',
            'Poste' => 'Directeur technique',
            'Entreprise' => 'Ubisoft'
        ]
    ];

    foreach ($contacts as $contact) {
        $stmt = $pdo->prepare('
            INSERT INTO Contacts (
                Nom, Prenom, Email, Telephone, Poste, ID_Entreprise
            ) VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $contact['Nom'],
            $contact['Prenom'],
            $contact['Email'],
            $contact['Telephone'],
            $contact['Poste'],
            $entrepriseIds[$contact['Entreprise']]
        ]);
    }

    echo "Contacts ajoutés.\n";

    // Ajouter des stages et candidatures
    $stages = [
        [
            'Entreprise' => 'Microsoft France',
            'Description' => 'Stage de développement web sur les technologies Microsoft Azure et .NET Core. Vous participerez à la création d\'applications web modernes et performantes.',
            'Lien_Offre' => 'https://careers.microsoft.com/stage-dev-2025',
            'Date_Postulation' => '2025-01-15',
            'Statut' => 'Candidature envoyée',
            'Commentaires' => 'CV et lettre de motivation envoyés par email. Attente de réponse.'
        ],
        [
            'Entreprise' => 'Orange Business Services',
            'Description' => 'Stage en cybersécurité pour participer à l\'audit et au renforcement des systèmes de sécurité des infrastructures cloud.',
            'Lien_Offre' => 'https://orange.jobs/stage-securite-2025',
            'Date_Postulation' => '2025-01-20',
            'Statut' => 'Entretien',
            'Commentaires' => 'Premier entretien téléphonique passé le 25/01. Entretien technique prévu pour le 05/02.'
        ],
        [
            'Entreprise' => 'Ubisoft',
            'Description' => 'Stage de développement de jeux vidéo avec Unity. Participation à la création de prototypes et implémentation de fonctionnalités.',
            'Lien_Offre' => 'https://jobs.ubisoft.com/stage-unity-2025',
            'Date_Postulation' => '2025-01-10',
            'Statut' => 'Refusé',
            'Commentaires' => 'Refus reçu par email le 30/01. Profil ne correspondant pas exactement aux besoins actuels.'
        ]
    ];

    // Récupérer les IDs des statuts
    $statutsMap = [];
    $stmt = $pdo->query("SELECT ID, Statut FROM Statuts");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $statutsMap[$row['Statut']] = $row['ID'];
    }

    foreach ($stages as $stage) {
        // Créer le stage
        $stmt = $pdo->prepare('
            INSERT INTO Stages (
                Lien_Offre, Description, Date_Postulation, ID_Entreprise
            ) VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $stage['Lien_Offre'],
            $stage['Description'],
            $stage['Date_Postulation'],
            $entrepriseIds[$stage['Entreprise']]
        ]);

        $stageId = $pdo->lastInsertId();

        // Créer la candidature
        $stmt = $pdo->prepare('
            INSERT INTO Candidatures (
                ID_Stage, ID_Statut, Date_Candidature, Commentaires
            ) VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $stageId,
            $statutsMap[$stage['Statut']],
            $stage['Date_Postulation'],
            $stage['Commentaires']
        ]);
    }

    echo "Stages et candidatures ajoutés.\n";
} else {
    echo "Des entreprises existent déjà, aucun ajout de données de test.\n";
}

echo "Initialisation terminée avec succès!\n";
