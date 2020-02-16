<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211235635 extends AbstractMigration
{
    use MigrationHelper;

    public function up(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql(
            'CREATE TABLE app_user_security_credential (
                user_id INT NOT NULL, 
                created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, 
                password VARCHAR(255) NOT NULL, 
                roles TEXT DEFAULT NULL, 
                salt VARCHAR(255) NOT NULL, 
                PRIMARY KEY(user_id)
            )'
        );
        $this->addSql("COMMENT ON COLUMN app_user_security_credential.created_at IS '(DC2Type:datetimetz_immutable)'");
        $this->addSql("COMMENT ON COLUMN app_user_security_credential.roles IS '(DC2Type:simple_array)'");
        $this->addSql(
            'ALTER TABLE app_user_security_credential ADD CONSTRAINT FK_36A80DF0A76ED395 FOREIGN KEY (user_id) 
                REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );

        $this->addSql('ALTER TABLE app_user DROP created_at;');
    }

    public function down(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql('DROP TABLE app_user_security_credential');
        $this->addSql('ALTER TABLE app_user ADD COLUMN created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL');
    }
}
