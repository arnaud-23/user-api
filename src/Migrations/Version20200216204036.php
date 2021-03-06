<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216204036 extends AbstractMigration
{
    use MigrationHelper;

    public function up(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql('ALTER TABLE oauth2_authorization_code ALTER expiry TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE oauth2_authorization_code ALTER expiry DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN oauth2_authorization_code.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE oauth2_access_token ALTER expiry TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE oauth2_access_token ALTER expiry DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN oauth2_access_token.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE oauth2_refresh_token ALTER expiry TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE oauth2_refresh_token ALTER expiry DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN oauth2_refresh_token.expiry IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();
        $this->addSql('ALTER TABLE oauth2_authorization_code ALTER expiry TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE oauth2_authorization_code ALTER expiry DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN oauth2_authorization_code.expiry IS NULL');
        $this->addSql('ALTER TABLE oauth2_access_token ALTER expiry TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE oauth2_access_token ALTER expiry DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN oauth2_access_token.expiry IS NULL');
        $this->addSql('ALTER TABLE oauth2_refresh_token ALTER expiry TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE oauth2_refresh_token ALTER expiry DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN oauth2_refresh_token.expiry IS NULL');
    }
}
