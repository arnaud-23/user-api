<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122191137 extends AbstractMigration
{
    use MigrationHelper;

    public function up(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
    }

    public function down(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql('DROP INDEX UNIQ_88BDF3E9E7927C74');
    }
}
