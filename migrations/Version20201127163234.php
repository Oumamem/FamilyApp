<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127163234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo ADD assigne_a_id INT DEFAULT NULL, DROP assigne_a, CHANGE termine termine TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0BB1B0F33 FOREIGN KEY (assigne_a_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_5A0EB6A0BB1B0F33 ON todo (assigne_a_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A0BB1B0F33');
        $this->addSql('DROP INDEX IDX_5A0EB6A0BB1B0F33 ON todo');
        $this->addSql('ALTER TABLE todo ADD assigne_a VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP assigne_a_id, CHANGE termine termine TINYINT(1) NOT NULL');
    }
}
