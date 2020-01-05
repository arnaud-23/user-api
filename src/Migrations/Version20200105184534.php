<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105184534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql(
            'CREATE TABLE app_user_security_credential (user_id INT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, password VARCHAR(255) NOT NULL, roles TEXT NOT NULL, salt VARCHAR(255) NOT NULL, PRIMARY KEY(user_id))'
        );
        $this->addSql(
            'COMMENT ON COLUMN app_user_security_credential.created_at IS \'(DC2Type:datetimetz_immutable)\''
        );
        $this->addSql('COMMENT ON COLUMN app_user_security_credential.roles IS \'(DC2Type:simple_array)\'');
        $this->addSql(
            'ALTER TABLE app_user_security_credential ADD CONSTRAINT FK_36A80DF0A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql('ALTER TABLE app_user DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE app_user_security_credential');
        $this->addSql('ALTER TABLE app_user ADD created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN app_user.created_at IS \'(DC2Type:datetimetz_immutable)\'');
    }
}
