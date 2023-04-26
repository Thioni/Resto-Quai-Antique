<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426174218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergen (id INT AUTO_INCREMENT NOT NULL, ingredient VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, email VARCHAR(254) NOT NULL, seats INT NOT NULL, timeslot DATETIME NOT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_allergen (booking_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_1E8B96433301C60 (booking_id), INDEX IDX_1E8B96436E775A4A (allergen_id), PRIMARY KEY(booking_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, category VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish_allergen (dish_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_3C4389A5148EB0CB (dish_id), INDEX IDX_3C4389A56E775A4A (allergen_id), PRIMARY KEY(dish_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, monday_open TIME DEFAULT NULL, monday_close TIME DEFAULT NULL, tuesday_open TIME DEFAULT NULL, tuesday_close TIME DEFAULT NULL, wednesday_open TIME DEFAULT NULL, wednesday_close TIME DEFAULT NULL, thursday_open TIME DEFAULT NULL, thursday_close TIME DEFAULT NULL, friday_open TIME DEFAULT NULL, friday_close TIME DEFAULT NULL, saturday_open TIME DEFAULT NULL, saturday_close TIME DEFAULT NULL, sunday_open TIME DEFAULT NULL, sunday_close TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, dish_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, selected TINYINT(1) NOT NULL, INDEX IDX_14B78418148EB0CB (dish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergen (user_id INT NOT NULL, allergen_id INT NOT NULL, INDEX IDX_C532ECCEA76ED395 (user_id), INDEX IDX_C532ECCE6E775A4A (allergen_id), PRIMARY KEY(user_id, allergen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_allergen ADD CONSTRAINT FK_1E8B96433301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_allergen ADD CONSTRAINT FK_1E8B96436E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dish_allergen ADD CONSTRAINT FK_3C4389A5148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dish_allergen ADD CONSTRAINT FK_3C4389A56E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE user_allergen ADD CONSTRAINT FK_C532ECCEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergen ADD CONSTRAINT FK_C532ECCE6E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking_allergen DROP FOREIGN KEY FK_1E8B96433301C60');
        $this->addSql('ALTER TABLE booking_allergen DROP FOREIGN KEY FK_1E8B96436E775A4A');
        $this->addSql('ALTER TABLE dish_allergen DROP FOREIGN KEY FK_3C4389A5148EB0CB');
        $this->addSql('ALTER TABLE dish_allergen DROP FOREIGN KEY FK_3C4389A56E775A4A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418148EB0CB');
        $this->addSql('ALTER TABLE user_allergen DROP FOREIGN KEY FK_C532ECCEA76ED395');
        $this->addSql('ALTER TABLE user_allergen DROP FOREIGN KEY FK_C532ECCE6E775A4A');
        $this->addSql('DROP TABLE allergen');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_allergen');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE dish_allergen');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_allergen');
    }
}
