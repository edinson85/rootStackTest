<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208170917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Agregando campo padre `categoria`';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE `categoria`
                ADD COLUMN padre_id CHAR(36) DEFAULT NULL');                
        $this->addSql('ALTER TABLE `categoria` 
                       ADD CONSTRAINT FK_categoria_padre_id FOREIGN KEY (padre_id) REFERENCES `categoria` (id) ON UPDATE CASCADE ON DELETE CASCADE');        
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE `categoria`DROP FOREIGN KEY FK_categoria_padre_id');        
        $this->addSql('ALTER TABLE `categoria` DROP COLUMN padre_id');
    }
}
