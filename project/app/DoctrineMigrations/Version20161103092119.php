<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161103092119 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cocktail (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, INDEX IDX_7B4914D4C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_component (id INT AUTO_INCREMENT NOT NULL, cocktail_id INT NOT NULL, ingredient_id INT NOT NULL, portion VARCHAR(255) NOT NULL, INDEX IDX_7B096113CD6F76C6 (cocktail_id), INDEX IDX_7B096113933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_BB183F292C2AC5D3 (translatable_id), UNIQUE INDEX cocktail_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_type (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_type_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_FEEA61472C2AC5D3 (translatable_id), UNIQUE INDEX cocktail_type_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_C1A8BF62C2AC5D3 (translatable_id), UNIQUE INDEX ingredient_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D4C54C8C93 FOREIGN KEY (type_id) REFERENCES cocktail_type (id)');
        $this->addSql('ALTER TABLE cocktail_component ADD CONSTRAINT FK_7B096113CD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id)');
        $this->addSql('ALTER TABLE cocktail_component ADD CONSTRAINT FK_7B096113933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE cocktail_translation ADD CONSTRAINT FK_BB183F292C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES cocktail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail_type_translation ADD CONSTRAINT FK_FEEA61472C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES cocktail_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_translation ADD CONSTRAINT FK_C1A8BF62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ingredient (id) ON DELETE CASCADE');

        $this->addSql('
            INSERT INTO cocktail_type (id) VALUES
            (1),
            (2);
            
            INSERT INTO cocktail_type_translation (translatable_id, title, locale) VALUES
            (1, "Лонг", "ru"),
            (2, "Шорт", "ru"),
            (1, "Long", "en"),
            (2, "Short", "en");
        ');

        $this->addSql('
            INSERT INTO ingredient (id) VALUES
            (1),
            (2),
            (3);
            
            INSERT INTO ingredient_translation (translatable_id, title, locale) VALUES
            (1, "Бэйлис", "ru"),
            (2, "Калуа", "ru"),
            (3, "Коентро", "ru"),
            (1, "Baileys", "en"),
            (2, "Kaluah", "en"),
            (3, "Cointreau", "en");
        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cocktail_component DROP FOREIGN KEY FK_7B096113CD6F76C6');
        $this->addSql('ALTER TABLE cocktail_translation DROP FOREIGN KEY FK_BB183F292C2AC5D3');
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D4C54C8C93');
        $this->addSql('ALTER TABLE cocktail_type_translation DROP FOREIGN KEY FK_FEEA61472C2AC5D3');
        $this->addSql('ALTER TABLE cocktail_component DROP FOREIGN KEY FK_7B096113933FE08C');
        $this->addSql('ALTER TABLE ingredient_translation DROP FOREIGN KEY FK_C1A8BF62C2AC5D3');
        $this->addSql('DROP TABLE cocktail');
        $this->addSql('DROP TABLE cocktail_component');
        $this->addSql('DROP TABLE cocktail_translation');
        $this->addSql('DROP TABLE cocktail_type');
        $this->addSql('DROP TABLE cocktail_type_translation');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_translation');
    }
}
