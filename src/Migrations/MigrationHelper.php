<?php

declare(strict_types=1);

namespace App\Migrations;

trait MigrationHelper
{
    public function abortIfNotPostgresqlDatabase(): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );
    }
}
