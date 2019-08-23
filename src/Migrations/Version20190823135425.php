<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190823135425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE entitlement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, wallet_uuid VARCHAR(32) DEFAULT NULL, uuid VARCHAR(32) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, cost DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FA448021BCEDA5A3 ON entitlement (wallet_uuid)');
        $this->addSql('CREATE TABLE wallet (uuid VARCHAR(32) NOT NULL, account_uuid INTEGER DEFAULT NULL, description VARCHAR(128) DEFAULT NULL, balance DOUBLE PRECISION NOT NULL, refundable DOUBLE PRECISION NOT NULL, currency VARCHAR(3) NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE INDEX IDX_7C68921F5DECD70C ON wallet (account_uuid)');
        $this->addSql('CREATE TABLE account (uuid INTEGER NOT NULL, display_name VARCHAR(255) NOT NULL, PRIMARY KEY(uuid))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE entitlement');
        $this->addSql('DROP TABLE wallet');
        $this->addSql('DROP TABLE account');
    }
}
