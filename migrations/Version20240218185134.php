<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218185134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre CHANGE id_category_id id_category_id INT NOT NULL, CHANGE experience_level experience_level VARCHAR(255) NOT NULL, CHANGE salary salary VARCHAR(255) NOT NULL, CHANGE language language JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre CHANGE id_category_id id_category_id INT DEFAULT NULL, CHANGE experience_level experience_level VARCHAR(11) NOT NULL, CHANGE salary salary VARCHAR(255) DEFAULT NULL, CHANGE language language VARCHAR(255) NOT NULL');
    }
}
