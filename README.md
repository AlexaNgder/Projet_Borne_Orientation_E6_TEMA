# 📍 Borne d’Orientation – Projet TEMA

> **Titre :** Conception d’un dispositif d’orientation des usagers dans le cadre d’un salon professionnel  
> **Auteur :** TEMA  (Tony Barelli, Evan Bonnal, Matthieu Caviggia, Alex Nguyen)  
> **formation :** BTS cybersécurité, informatique et réseaux, électronique option A informatique et réseaux (CIEL IR)  
> **Période :** janvier – fin mai 2025 (10 semaines)  
> **Établissement :** Lycée Rempart-Vinci  

---

## 📝 Introduction

Bienvenue dans le dépôt **Borne d’Orientation**, réalisé par l’équipe **TEMA** (Tony Barelli, Evan Bonnal, Matthieu Caviggia, Alex Nguyen) dans le cadre de l’épreuve E6 du BTS CIEL Informatique et Réseaux (session 2024-2025).

Ce projet consiste à concevoir et déployer une **borne interactive** capable de :

- 👤 **Guider** les visiteurs lors des Journées Portes Ouvertes  
- 📱 **Générer** automatiquement un QR-Code pour un itinéraire personnalisé  
- 🗺️ **Superposer** dynamiquement des flèches et pictogrammes sur un plan via PHP & Canvas  
- 📧 Proposer un **abonnement newsletter** et envoyer des e-mails via SMTP (IONOS)  
- 🔒 Gérer un espace **administrateur sécurisé** (badge RFID + authentification PHP)  

L’objectif à long terme est d’optimiser l’accessibilité des personnes en situation de handicap dans toute structure labyrinthique (établissements, musées, hôpitaux, …).

---

## 🎬 Démonstrations en GIF

### 1. Parcours utilisateur et abonnement  
<p>
  Dans cette animation, on clique sur une formation depuis le dashboard, puis on scanne le QR-Code avec un smartphone.  
  Le site de guidage s’ouvre et vous oriente visuellement vers la salle de formation.  
  En bas de la page, nous proposons un bouton « Recevoir des informations » :  
  l’utilisateur remplit un court formulaire et reçoit ensuite les plaquettes PDF des BTS proposés.
</p>
<p align="center">
  <img src="./Rapport de projet/demo-dashboard.gif" alt="Démo Dashboard et guidage" />
</p>

---

### 2. Réception de la plaquette par e-mail  
<p>
  Ici, on voit la boîte mail s’ouvrir après l’envoi automatique du système.  
  Le visiteur reçoit une plaquette BTS au format PDF en pièce jointe, prête à être consultée ou partagée.
</p>
<p align="center">
  <img src="./Rapport de projet/demo-mail.gif" alt="Démo réception de mail avec plaquette PDF" />
</p>


---

### 3. Authentification et statistiques  
<p>
  Cette animation illustre le processus d’authentification par login/MDP pour accéder au module « Statistiques ».  
  On y affiche le nombre de visites par heure, la moyenne, le maximum, le minimum et le total.  
  Un bouton permet d’exporter ces données au format Excel.  
  Enfin, un onglet « Étudiants » liste les formulaires remplis (nom, prénom, e-mail, etc.) avec possibilité de rechercher et d’exporter les résultats,  
  idéal pour le suivi des visiteurs sur Parcoursup ou lors des JPO.
</p>
<p align="center">
  <img src="./Rapport de projet/demo-stats.gif" alt="Démo authentification et statistiques" />
</p>


---

### 4. Conception d’un générateur d’itinéraires  
<p>
  Ce module local permet aux administrateurs de charger un plan, d’ajouter dynamiquement des flèches et pictogrammes,  
  puis d’ajuster leur position en temps réel avant de télécharger l’itinéraire final au format image, avec possibilité de renommer le fichier.  
  Grâce à une interface épurée en PHP et JavaScript, ils bénéficient d’un aperçu instantané et d’un export direct  
  pour une intégration fluide dans le module de guidage BTS.
</p>

> **Manuel d’utilisation**  
> Pour consulter la documentation détaillée de cet outil, exportez le dépôt Git puis ouvrez  
> `Projet_Borne_Orientation_E6_TEMA/Rapport de projet/Rapport de projet E6 NGUYEN Alex.pdf` à la page 46. 

<p align="center">
  <img src="./Rapport de projet/Générateur_de_guide_demo.gif" alt="Démo authentification et statistiques" />
</p>

---

## 🤝 Équipe

<table>
  <thead>
    <tr>
      <th>Avatar</th>
      <th>Membre</th>
      <th>Rôle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="center">
        <img src="https://github.com/Cavigus.png?size=32" alt="Matthieu Caviggia" style="width:40px; height:40px; border-radius:4px;" />
      </td>
      <td><strong>Matthieu Caviggia</strong></td>
      <td>Front-end (Bootstrap, QR-Code, Raspberry Pi)</td>
    </tr>
    <tr>
      <td align="center">
        <img src="https://github.com/Anthony19-20.png?size=32" alt="Tony Barelli" style="width:40px; height:40px; border-radius:4px;" />
      </td>
      <td><strong>Tony Barelli</strong></td>
      <td>Full-stack (PHP, base de données, interface)</td>
    </tr>
    <tr>
      <td align="center">
        <img src="https://github.com/AlexaNgder.png?size=32" alt="Alex Nguyen" style="width:40px; height:40px; border-radius:4px;" />
      </td>
      <td><strong>Alex Nguyen</strong></td>
      <td>Full-stack (PHP Canvas, mailing, déploiement)</td>
    </tr>
    <tr>
      <td align="center">
        <img src="https://github.com/evanbonnal.png?size=32" alt="Evan Bonnal" style="width:40px; height:40px; border-radius:4px;" />
      </td>
      <td><strong>Evan Bonnal</strong></td>
      <td>Full-stack (Token, sessions, stats Chart)</td>
    </tr>
  </tbody>
</table>

---

## 📅 Planning & Diagramme de Gantt 2025

<section>
  <p align="center">
    Pour mieux visualiser la répartition des tâches et leur avancement, consultez notre diagramme de Gantt :
  </p>
  <p align="center">
    <a href="https://docs.google.com/spreadsheets/d/15KmgNGNBMsIUy_CNxxtfsMC6VmbXhnEo/edit?usp=sharing&ouid=115592501527481610452&rtpof=true&sd=true" 
       target="_blank" 
       style="font-size: 1.1em; color: #1a73e8; text-decoration: none; border: 1px solid #1a73e8; padding: 0.5em 1em; border-radius: 4px;">
      👉 Ouvrir le Gantt dans Google Sheets
    </a>
  </p>
  <p style="max-width: 800px; margin: auto; text-align: justify;">
    Ce planning, réalisé sur 10 semaines, détaille pour chaque phase :
    <ul>
      <li><strong>Phase 1 – E1 (Matthieu CAVIGGIA)</strong> : Front-end, QR-code, installation RPI4 et RFID.</li>
      <li><strong>Phase 2 – E2 (Tony BARELLI)</strong> : Simulateur de déplacement, BDD itinéraires, contacts utilisateurs.</li>
      <li><strong>Phase 3 – E3 (Alex NGUYEN)</strong> : Générateur d’itinéraire, envoi d’e-mails, hébergement IONOS, auth admin.</li>
      <li><strong>Phase 4 – E4 (Evan BONNAL)</strong> : Cybersécurité, statistiques, export Excel, écran tactile RPI4, session login.</li>
    </ul>
    Chaque tâche y est datée (début/fin), avec un statut de progression et l’auteur responsable, pour garantir la transparence et le suivi rigoureux du projet.
  </p>
</section>

---

## 📐 Architecture & Diagrammes

<section>
  <p align="center">
    Ces cinq diagrammes offrent une vue d’ensemble de notre borne d’orientation :
  </p>
  <ul style="list-style-type: none; padding: 0; max-width: 800px; margin: auto;">
    <li style="margin-bottom: 2em;">
      <h3 style="text-align: center;">Diagramme de cas d’utilisation UML</h3>
      <p style="text-align: justify;">
        Ce diagramme décrit les interactions principales entre les utilisateurs (visiteurs et administrateurs) et
        notre système de borne d’orientation, depuis la sélection de formation jusqu’à la gestion des accès.
      </p>
      <div align="center">
        <img
          src="Rapport de projet/Diag cas d’utilisation.png"
          alt="Diagramme cas d’utilisation UML"
          style="width: 80%; border: 1px solid #ccc; border-radius: 4px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);"
        />
      </div>
    </li>
    <li style="margin-bottom: 2em;">
      <h3 style="text-align: center;">Diagramme de séquence UML</h3>
      <p style="text-align: justify;">
        Ce diagramme détaille le déroulement temporel des échanges entre les composants, de la génération du QR code
        jusqu’au suivi du parcours sur le site web de guidage.
      </p>
      <div align="center">
        <img
          src="Rapport de projet/Diag de séquence.png"
          alt="Diagramme de séquence UML"
          style="width: 80%; border: 1px solid #ccc; border-radius: 4px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);"
        />
      </div>
    </li>
    <li style="margin-bottom: 2em;">
      <h3 style="text-align: center;">Synoptique du projet</h3>
      <p style="text-align: justify;">
        La synoptique présente l’architecture globale de la borne, du matériel (Raspberry Pi, écran tactile, RFID)
        aux modules logiciels (dashboard, scanner & guidage, envoi d’e-mails).
      </p>
      <div align="center">
        <img
          src="Rapport de projet/Synoptique du projet.png"
          alt="Synoptique du projet"
          style="width: 80%; border: 1px solid #ccc; border-radius: 4px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);"
        />
      </div>
    </li>
    <li style="margin-bottom: 2em;">
      <h3 style="text-align: center;">Diagramme d’exigences SysML</h3>
      <p style="text-align: justify;">
        Ce diagramme synthétise les exigences fonctionnelles, non-fonctionnelles et techniques de la borne,
        organisées en modules (Dashboard, Scanner & Guidage, Composants Techniques) et hiérarchisées
        pour garantir traçabilité et conformité au cahier des charges.
      </p>
      <div align="center">
        <img
          src="Rapport de projet/Diag d’exigence.png"
          alt="Diagramme d’exigences SysML"
          style="width: 80%; border: 1px solid #ccc; border-radius: 4px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);"
        />
      </div>
    </li>
    <li style="margin-bottom: 2em;">
      <h3 style="text-align: center;">Diagramme de la base de données</h3>
      <p style="text-align: justify;">
        Le diagramme de la base de données représente les tables principales (Clients, Identifications, 
        Parcours, Visites) et leurs relations, illustrant la structure du schéma SQL utilisé pour stocker 
        les informations du projet.
      </p>
      <div align="center">
        <img
          src="Rapport de projet/Diag de la BDD.png"
          alt="Diagramme de la base de données"
          style="width: 80%; border: 1px solid #ccc; border-radius: 4px; box-shadow: 2px 2px 6px rgba(0,0,0,0.1);"
        />
      </div>
    </li>
  </ul>
</section>

---

## 🚀 Fonctionnalités clés

| Fonctionnalité                        | Détail                                                                                   |
|---------------------------------------|------------------------------------------------------------------------------------------|
| **Sélection de formation**            | Écran tactile responsive basé sur Bootstrap                                              |
| **Génération QR-Code**                | Création dynamique d’un QR-Code via JavaScript                                           |
| **Module de guidage**                 | Superposition de flèches/images sur plan via PHP & HTML5 Canvas                          |
| **Collecte des données**              | Exportation Excel via PHP des données clients et statistiques de visites par heure       |
| **Newsletter & e-mails**              | Abonnement par formulaire + envoi via PHPMailer et serveur SMTP IONOS                    |
| **Authentification administrateur**   | Contrôle d’accès par session PHP  + tokenisation en PHP                                  |
| **Statistiques de visite**            | Suivi et affichage du nombre de scans/visites par heure                                  |

---

## 📂 Structure du dépôt

```plaintext
.
├── Dashboard/                          # Interface utilisateur locale de la borne (frontend)
│   ├── Images/                         # Ressources graphiques spécifiques au dashboard
│   ├── accueil.html                    # Page d’accueil statique affichée sur la borne
│   ├── album.css                       # Feuille de style CSS pour la mise en forme de l’interface
│   └── borne_v3.php                    # Script PHP principal pour l’interaction avec la borne
│
├── Generateur des guides/              # Module de génération des itinéraires en local (admin)
│   ├── Images/                         # Flèches ou éléments graphiques pour les parcours
│   ├── Images_Final/                   # Versions finales des images générées automatiquement
│   └── index.php                       # Script PHP de génération de guides dynamiques
│
├── OrienInfor/                         # Application hébergée sur le site web public (serveur IONOS)
│   ├── Images/                         # Illustrations diverses de l’interface web
│   ├── css/                            # Feuilles de style CSS pour le site web
│   ├── js/                             # Scripts JavaScript pour animations et fonctionnalités
│   ├── PHPMailer/                      # Librairie pour l’envoi d’e-mails via SMTP
│   ├── phpoffice/                      # Librairie PHP pour l’export Excel (statistiques)
│   ├── Plaquette_BTS/                  # Plaquettes PDF des formations présentées sur la borne
│   ├── vendor/                         # Dépendances gérées par Composer (librairies tierces)
│   ├── index.php                       # Page d’entrée principale avec formulaire de login
│   ├── schema.sql                      # Structure de la base de données 
│   └── ...                             # Autres fichiers pour Admin/Parcours (statistiques, export Excel, etc.)
│
├── Rapport de projet/                  # Dossier de documentation, livrables et illustrations
│   ├── Diag cas d’utilisation.png      # Diagramme UML des cas d’utilisation du système
│   ├── Diag d’exigence.png             # Diagramme SysML des exigences fonctionnelles
│   ├── Diag de séquence.png            # Diagramme UML illustrant la séquence d’interactions
│   ├── Présentation_projet.pdf         # Dossier de présentation du projet
│   ├── Fiche de validation projet.pdf  # Document validant officiellement le projet
│   ├── Rapport de projet E6.pdf        # Rapport complet pour l’épreuve E6 
│   └── Synoptique du projet.png        # Vue d’ensemble de l’architecture matérielle et logicielle
│
├── LICENSE                             # Détail de la licence d’utilisation du code (MIT)
└── README.md                           # Fichier d’introduction et de présentation du projet sur GitHub

```
## 🛠️ Installation & Déploiement

1. **Cloner** le dépôt Git
   ```bash
   git clone https://github.com/AlexaNgder/Projet_Borne_Orientation_E6_TEMA.git
   cd Projet_Borne_Orientation_E6_TEMA

---

## 📄 Licence

Ce projet est distribué sous la [Licence MIT](LICENSE).
