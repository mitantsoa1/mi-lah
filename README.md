
# Projet Symfony

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP >= 8.0
- Composer
- MySQL (ou tout autre SGBD pris en charge par Symfony)
- Node.js & NPM
- Symfony CLI (facultatif mais recommandé)

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/mitantsoa1/mi-lah.git
cd mi-lah
```

### 2. Installer les dépendances PHP et JavaScript

```bash
composer install
npm install
npm run dev
```

### 3. Configurer l'environnement

Copiez le fichier `.env.example` vers `.env` et configurez les variables d'environnement.

```bash
cp .env.example .env
```

Générez la clé de sécurité pour l'application (si nécessaire).

```bash
php bin/console secret:generate
```

### 4. Configurer la base de données

Modifiez le fichier `.env` pour configurer la connexion à la base de données :

```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
```

Ensuite, exécutez les migrations pour créer les tables dans la base de données :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Lancer l'application

Démarrez le serveur Symfony :

```bash
symfony server:start
```

Ou utilisez la commande PHP intégrée :

```bash
php -S 127.0.0.1:8000 -t public
```

### 6. Accéder à l'application

Vous pouvez maintenant accéder à l'application à l'adresse suivante : `http://127.0.0.1:8000`.
