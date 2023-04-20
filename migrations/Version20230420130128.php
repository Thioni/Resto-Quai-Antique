<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420130128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, email VARCHAR(254) NOT NULL, seats INT NOT NULL, timeslot DATETIME NOT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_allergen (booking_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_1E8B96433301C60 (booking_id), INDEX IDX_1E8B96436E775A4A (allergen_id), PRIMARY KEY(booking_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, monday_open TIME DEFAULT NULL, monday_close TIME DEFAULT NULL, tuesday_open TIME DEFAULT NULL, tuesday_close TIME DEFAULT NULL, wednesday_open TIME DEFAULT NULL, wednesday_close TIME DEFAULT NULL, thursday_open TIME DEFAULT NULL, thursday_close TIME DEFAULT NULL, friday_open TIME DEFAULT NULL, friday_close TIME DEFAULT NULL, saturday_open TIME DEFAULT NULL, saturday_close TIME DEFAULT NULL, sunday_open TIME DEFAULT NULL, sunday_close TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergen (user_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_C532ECCEA76ED395 (user_id), INDEX IDX_C532ECCE6E775A4A (allergen_id), PRIMARY KEY(user_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_allergen ADD CONSTRAINT FK_1E8B96433301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_allergen ADD CONSTRAINT FK_1E8B96436E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergen ADD CONSTRAINT FK_C532ECCEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergen ADD CONSTRAINT FK_C532ECCE6E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418148EB0CB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(20) NOT NULL, ADD lastname VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking_allergen DROP FOREIGN KEY FK_1E8B96433301C60');
        $this->addSql('ALTER TABLE booking_allergen DROP FOREIGN KEY FK_1E8B96436E775A4A');
        $this->addSql('ALTER TABLE user_allergen DROP FOREIGN KEY FK_C532ECCEA76ED395');
        $this->addSql('ALTER TABLE user_allergen DROP FOREIGN KEY FK_C532ECCE6E775A4A');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_allergen');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE user_allergen');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418148EB0CB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname');
    }
}
