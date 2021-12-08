<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208155006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creando tabla `categoria`';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE `categoria` (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                id_page VARCHAR(100) NOT NULL,
                path VARCHAR(100) NOT NULL,                
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX IDX_categoria_id_page (id_page),
                CONSTRAINT U_categoria_id_page UNIQUE KEY (id_page)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE `categoria`');

    }
}
