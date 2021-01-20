<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120191813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, termine TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_26A984566A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, rolefamille_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, description LONGTEXT DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, pathcover VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F6B4FB2997A77B84 (famille_id), UNIQUE INDEX UNIQ_F6B4FB298BCF0945 (rolefamille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE souvenir (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, date DATE DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_53FBDDEE97A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, assigne_a_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, termine TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5A0EB6A06A99F74A (membre_id), INDEX IDX_5A0EB6A0BB1B0F33 (assigne_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_membre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984566A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2997A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB298BCF0945 FOREIGN KEY (rolefamille_id) REFERENCES type_membre (id)');
        $this->addSql('ALTER TABLE souvenir ADD CONSTRAINT FK_53FBDDEE97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A06A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0BB1B0F33 FOREIGN KEY (assigne_a_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2997A77B84');
        $this->addSql('ALTER TABLE souvenir DROP FOREIGN KEY FK_53FBDDEE97A77B84');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984566A99F74A');
        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A06A99F74A');
        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A0BB1B0F33');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB298BCF0945');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE souvenir');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE type_membre');
    }
}
