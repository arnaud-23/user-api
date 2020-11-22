<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200809163918 extends AbstractMigration
{
    use MigrationHelper;

    public function up(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();

        $this->addSql(
            'CREATE TABLE app_application_user (id SERIAL NOT NULL, user_id INT DEFAULT NULL, application_id INT DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EE415F60A76ED395 ON app_application_user (user_id)');
        $this->addSql('CREATE INDEX IDX_EE415F603E030ACD ON app_application_user (application_id)');
        $this->addSql(
            'ALTER TABLE app_application_user ADD CONSTRAINT FK_EE415F60A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
        $this->addSql(
            'ALTER TABLE app_application_user ADD CONSTRAINT FK_EE415F603E030ACD FOREIGN KEY (application_id) REFERENCES app_application (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIfNotPostgresqlDatabase();

        $this->addSql('DROP TABLE app_application_user');
    }
}
