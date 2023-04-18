<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230418162610 extends AbstractMigration
{

    public function getDescription(): string
    {
        return '';
    }
    
    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418148EB0CB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418148EB0CB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
    }

}