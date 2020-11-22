<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191116164306 extends AbstractMigration
{
    use MigrationHelper;

    public function up(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql(
            'CREATE TABLE app_user (
                id SERIAL NOT NULL, 
                uuid VARCHAR(255) NOT NULL, 
                created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, 
                email VARCHAR(255) NOT NULL, 
                first_name VARCHAR(255) NOT NULL, 
                last_name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            )'
        );
        $this->addSql('COMMENT ON COLUMN app_user.created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9D17F50A6 ON app_user (uuid)');
    }

    public function down(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql('DROP TABLE app_user');
    }
}
