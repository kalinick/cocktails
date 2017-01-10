<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161103104624 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cocktail (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, INDEX IDX_7B4914D4C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_component (id INT AUTO_INCREMENT NOT NULL, cocktail_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_7B096113CD6F76C6 (cocktail_id), INDEX IDX_7B096113933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_component_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, portion VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_8EEBF7A72C2AC5D3 (translatable_id), UNIQUE INDEX cocktail_component_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_BB183F292C2AC5D3 (translatable_id), UNIQUE INDEX cocktail_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_type (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_type_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_FEEA61472C2AC5D3 (translatable_id), UNIQUE INDEX cocktail_type_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, INDEX IDX_6BAF7870C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_C1A8BF62C2AC5D3 (translatable_id), UNIQUE INDEX ingredient_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_type (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_type_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_CF5FBC132C2AC5D3 (translatable_id), UNIQUE INDEX ingredient_type_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D4C54C8C93 FOREIGN KEY (type_id) REFERENCES cocktail_type (id)');
        $this->addSql('ALTER TABLE cocktail_component ADD CONSTRAINT FK_7B096113CD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id)');
        $this->addSql('ALTER TABLE cocktail_component ADD CONSTRAINT FK_7B096113933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE cocktail_component_translation ADD CONSTRAINT FK_8EEBF7A72C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES cocktail_component (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail_translation ADD CONSTRAINT FK_BB183F292C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES cocktail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail_type_translation ADD CONSTRAINT FK_FEEA61472C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES cocktail_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870C54C8C93 FOREIGN KEY (type_id) REFERENCES ingredient_type (id)');
        $this->addSql('ALTER TABLE ingredient_translation ADD CONSTRAINT FK_C1A8BF62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_type_translation ADD CONSTRAINT FK_CF5FBC132C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ingredient_type (id) ON DELETE CASCADE');

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
            INSERT INTO ingredient_type (id) VALUES
            (1),
            (2),
            (3),
            (4);
            
            INSERT INTO ingredient_type_translation (translatable_id, title, locale) VALUES
            (1, "Алкоголь", "ru"),
            (2, "Безалкогольный", "ru"),
            (3, "Фрукты", "ru"),
            (4, "Другое", "ru"),
            (1, "Alcohol", "en"),
            (2, "Nonalcohol", "en"),
            (3, "Fruit", "en"),
            (4, "Other", "en");
        ');

        $this->addSql('
            INSERT INTO ingredient (id, type_id) VALUES
            (1, 1),
            (2, 1),
            (3, 1),
            (4, 1),
            (5, 1),
            (6, 1),
            (7, 1),
            (8, 1),
            (9, 2),
            (10, 2),
            (11, 2),
            (12, 2),
            (13, 2),
            (14, 2),
            (15, 2),
            (16, 2),
            (17, 4);
            
            INSERT INTO ingredient_translation (translatable_id, title, locale) VALUES
            (1, "Бэйлис", "ru"),
            (2, "Калуа", "ru"),
            (3, "Коентро", "ru"),
            (4, "Ром светлый", "ru"),
            (5, "Ром темный", "ru"),
            (6, "Малибу", "ru"),
            (7, "Мартини", "ru"),
            (8, "Шампанское", "ru"),
            (9, "Сахарный сироп", "ru"),
            (10, "Грейпфрутовый сок", "ru"),
            (11, "Апельсиновый сок", "ru"),
            (12, "Лимонный сок", "ru"),
            (13, "Ананасовый сок", "ru"),
            (14, "Вода", "ru"),
            (15, "Кола", "ru"),
            (16, "Сливки", "ru"),
            (17, "Лед", "ru"),
            (1, "Baileys", "en"),
            (2, "Kaluah", "en"),
            (3, "Cointreau", "en");
        ');

        $this->addSql('
            INSERT INTO cocktail (id, type_id) VALUES
            (1, 2),
            (2, 1),
            (3, 1),
            (4, 1),
            (5, 1),
            (6, 1),
            (7, 1),
            (8, 1),
            (9, 1),
            (10, 1),
            (11, 1),
            (12, 1),
            (13, 1);
            
            INSERT INTO cocktail_translation (translatable_id, title, locale) VALUES
            (1, "Б52", "ru"),
            (2, "Пина Колада", "ru"),
            (3, "Мальдивы", "ru"),
            (4, "Дайкири", "ru"),
            (5, "Плантатор", "ru"),
            (6, "Буравчик", "ru"),
            (7, "Трофей", "ru"),
            (8, "Парижанка-блондинка", "ru"),
            (9, "Маленький цветок", "ru"),
            (10, "Фиговый листок", "ru"),
            (11, "Александр с ромом", "ru"),
            (12, "Вермут Шампань", "ru"),
            (13, "Багама Мама", "ru");
        ');

        $this->addSql('
            INSERT INTO cocktail_component (id, cocktail_id, ingredient_id) VALUES
            (1, 1, 1),
            (2, 1, 2),
            (3, 1, 3),
            (4, 2, 13),
            (5, 2, 4),
            (6, 2, 6),
            (7, 2, 17),
            (8, 3, 6),
            (9, 3, 16),
            (10, 3, 13),
            (11, 4, 9),
            (12, 4, 12),
            (13, 4, 4),
            (14, 5, 5),
            (15, 5, 12),
            (16, 5, 11),
            (17, 5, 16);
            
            INSERT INTO cocktail_component_translation (translatable_id, portion, locale) VALUES
            (1, "30мл", "ru"),
            (2, "30мл", "ru"),
            (3, "30мл", "ru"),
            (4, "75мл", "ru"),
            (5, "50мл", "ru"),
            (6, "75мл", "ru"),
            (7, "50мл", "ru"),
            (8, "50мл", "ru"),
            (9, "50мл", "ru"),
            (10, "100мл", "ru"),
            (11, "10мл", "ru"),
            (12, "30мл", "ru"),
            (13, "60мл", "ru"),
            (14, "40мл", "ru"),
            (15, "20мл", "ru"),
            (16, "30мл", "ru"),
            (17, "7-8 кубиков", "ru");
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
        $this->addSql('ALTER TABLE cocktail_component_translation DROP FOREIGN KEY FK_8EEBF7A72C2AC5D3');
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D4C54C8C93');
        $this->addSql('ALTER TABLE cocktail_type_translation DROP FOREIGN KEY FK_FEEA61472C2AC5D3');
        $this->addSql('ALTER TABLE cocktail_component DROP FOREIGN KEY FK_7B096113933FE08C');
        $this->addSql('ALTER TABLE ingredient_translation DROP FOREIGN KEY FK_C1A8BF62C2AC5D3');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870C54C8C93');
        $this->addSql('ALTER TABLE ingredient_type_translation DROP FOREIGN KEY FK_CF5FBC132C2AC5D3');
        $this->addSql('DROP TABLE cocktail');
        $this->addSql('DROP TABLE cocktail_component');
        $this->addSql('DROP TABLE cocktail_translation');
        $this->addSql('DROP TABLE cocktail_type');
        $this->addSql('DROP TABLE cocktail_type_translation');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_translation');
        $this->addSql('DROP TABLE ingredient_type');
        $this->addSql('DROP TABLE ingredient_type_translation');
    }
}
