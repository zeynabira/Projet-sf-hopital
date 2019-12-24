<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191214163039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE medecin_specialite (medecin_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_3F5A311B4F31A84 (medecin_id), INDEX IDX_3F5A311B2195E0F0 (specialite_id), PRIMARY KEY(medecin_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medecin_specialite ADD CONSTRAINT FK_3F5A311B4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_specialite ADD CONSTRAINT FK_3F5A311B2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE specialite_medecin');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C65C05E86C');
        $this->addSql('DROP INDEX IDX_1BDA53C65C05E86C ON medecin');
        $this->addSql('ALTER TABLE medecin DROP sevice_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE specialite_medecin (specialite_id INT NOT NULL, medecin_id INT NOT NULL, INDEX IDX_24D341422195E0F0 (specialite_id), INDEX IDX_24D341424F31A84 (medecin_id), PRIMARY KEY(specialite_id, medecin_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE specialite_medecin ADD CONSTRAINT FK_24D341422195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_medecin ADD CONSTRAINT FK_24D341424F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE medecin_specialite');
        $this->addSql('ALTER TABLE medecin ADD sevice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C65C05E86C FOREIGN KEY (sevice_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C65C05E86C ON medecin (sevice_id)');
    }
}
