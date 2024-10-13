<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013151230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `agence` (`id`, `nom`, `adresse`) VALUES (1, 'A01', 'Tana 1'),(2, 'Siège', 'Tananarive'),(3, 'agence3', 'Tana 3');");
        $this->addSql("INSERT INTO `fonction` (`id`, `libelle`, `description`, `code`) VALUES(1, 'Caissier', '<div>Caissier</div>', 'CAI'),(2, 'Accueil', '<div>Chargé d\'accueil</div>', 'ACC'),(3, 'administrator', '<div>Administrateur</div>', 'administrator'),(4, 'Receptioniste', '<div>Accueil agence</div>', 'agence1'),(5, 'Chef d\'agence', '<div>Chef d\'agence</div>', 'chef');");
        $this->addSql("INSERT INTO `operation` (`id`, `fonction_id`, `libelle`, `description`, `type`) VALUES(1, 1, 'Dépôt/retrait espèce', NULL, 'ESP'),(2, 1, 'Change', 'Change manuel', 'MC'),(3, 1, 'Dépôt/retrait chèque', NULL, 'CHQ'),(4, 2, 'Virement', 'Ordre de virement', 'VIR'),(5, 2, 'Information', 'Demande d\'information', 'INF'),(6, 1, 'Transferts', 'transferts internationaux', 'TRI');");
        $this->addSql("INSERT INTO `queued` (`id`, `type`, `numero`, `user`, `created_at`, `updated_at`, `status`, `position`, `agence`) VALUES(1, 'ESP', '048', NULL, '2024-05-01 09:44:08', NULL, 'A', '1', '1'),(2, 'VIR', '062', 'accueil1', '2024-05-01 09:44:22', '2024-05-01 09:59:13', 'E', '2', '1'),(3, 'CHQ', '640', NULL, '2024-05-01 09:54:00', NULL, 'A', '1', '1'),(4, 'INF', '483', NULL, '2024-05-01 10:24:43', NULL, 'A', '2', '3'),(5, 'ESP', '499', NULL, '2024-05-01 10:24:59', NULL, 'A', '1', '3'),(6, 'ESP', '532', 'caisse3', '2024-05-02 07:38:52', '2024-05-02 07:40:06', 'T', '1', '3'),(7, 'CHQ', '538', 'caisse3', '2024-05-02 07:38:58', '2024-05-02 09:11:47', 'T', '1', '3'),(8, 'INF', '543', NULL, '2024-05-02 07:39:03', NULL, 'A', '2', '3'),(9, 'VIR', '545', NULL, '2024-05-02 07:39:05', NULL, 'A', '2', '3'),(10, 'ESP', '162', 'caisse3', '2024-05-02 09:12:42', '2024-05-02 15:02:24', 'T', '1', '3'),(11, 'MC', '471', 'caisse3', '2024-05-02 09:17:51', '2024-05-02 09:21:35', 'T', '1', '3'),(12, 'MC', '633', NULL, '2024-08-10 10:43:53', NULL, 'A', '1', '1'),(13, 'ESP', '800', 'caisse1', '2024-10-13 14:06:40', '2024-10-13 14:07:29', 'T', '1', '1');");

        //password: 123456
        $this->addSql('
    INSERT INTO `user` 
        (`id`, `fonction_id`, `agence_id`, `login`, `roles`, `password`, `nom`, `prenom`, `email`) 
    VALUES 
        (2, 1, 1, "caisse1", \'[]\', "$2y$13$qmXgUuvqNog3mIQSrUABYuECHaS/KQXhyzD1sVF97caxuaamQwoBK", "Caissier", "agence 01", "caissier@caiss.com"),
        (3, 4, 1, "agence1", \'[]\', "$2y$13$toRjwiJoEJNeKSqWkGuO.OFx21AJeYKA37doC5A8xfL/7F1JCteT2", "Réception agence 1", NULL, NULL),
        (4, 4, 3, "agence3", \'[]\', "$2y$13$Blp8n2NMKsfa/39YqK4DLe56HYqU4Pk.VKt6lgiD.AGW9Lu/PsRle", "agence 3", NULL, NULL),
        (5, 1, 3, "caisse3", \'[]\', "$2y$13$i7piDZ9r.X/0NXIqZAbXfueEQko32fXxtEXUrPimXmHHBpMzFf08S", "Caisse agence 3", NULL, NULL),
        (6, 2, 3, "accueil3", \'[]\', "$2y$13$h27PncejsNgecFdAFPeCKOq06NhfVImu3pfZ56EMm/tyV21aiT9du", "Accueil agence 3", NULL, NULL),
        (7, 2, 1, "accueil1", \'[]\', "$2y$13$r0WOwUoYQfzAxKMfYs157umaRfmYzuYMgS5z7YEhlt5Xz5fgn8ejW", "Accueil agence 1", NULL, NULL),
        (8, 5, 1, "chef1", \'[]\', "$2y$13$lXuj4I2fZGx3ILGx6LmEuOkxMCOBsQzcRlsjHW2ff1KQNt94fZKJ2", "Chef agence 1", NULL, NULL),
        (9, 5, 3, "chef3", \'[]\', "$2y$13$mmA/t3aswSCv94uyNxYlRuQpxE/wT8nq00zMkvwlMclNR8ztZzJ6S", "Chef agence 3", NULL, NULL),
        (1, 3, 2, "admin", \'["ROLE_ADMIN"]\', "$2y$13$NmVubg.1Zevh5K2QrIpT2ui2UmlVu.AB0XuFYZ.dcdtlLKGDYkDeq", "Administrateur", NULL, "admin@admin.com");
');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE agence');
        $this->addSql('TRUNCATE TABLE fonction');
        $this->addSql('TRUNCATE TABLE user');
        $this->addSql('TRUNCATE TABLE queued');
    }
}
