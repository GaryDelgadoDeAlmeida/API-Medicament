<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430210857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, code_cis INT NOT NULL, code_cip INT NOT NULL, name VARCHAR(255) NOT NULL, administration_status VARCHAR(255) NOT NULL, marketing_status VARCHAR(255) NOT NULL, marketing_date DATE NOT NULL, code_cip13 INT NOT NULL, collectivity_agreement TINYINT(1) NOT NULL, repayment_percentage_rate DOUBLE PRECISION DEFAULT NULL, medication_price LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', indication_repayment_right LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE presentation');
    }
}
