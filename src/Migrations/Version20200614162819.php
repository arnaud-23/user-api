<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614162819 extends AbstractMigration
{
    use MigrationHelper;

    public function up(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();

        $this->addSql(
            'CREATE TABLE app_application (id SERIAL NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, uuid VARCHAR(255) NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDBEFB7DD17F50A6 ON app_application (uuid)');
        $this->addSql('CREATE INDEX IDX_FDBEFB7DA76ED395 ON app_application (user_id)');
        $this->addSql(
            'ALTER TABLE app_application ADD CONSTRAINT FK_FDBEFB7DA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();

        $this->addSql('DROP TABLE app_application');
    }
}
