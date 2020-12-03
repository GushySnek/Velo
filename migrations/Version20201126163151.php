<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126163151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, content LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, last_update DATETIME DEFAULT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), INDEX IDX_DADD4A25B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, advert_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_update DATETIME DEFAULT NULL, INDEX IDX_B6F7494ED07ECCB6 (advert_id), INDEX IDX_B6F7494EB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search (id INT AUTO_INCREMENT NOT NULL, keyword VARCHAR(255) DEFAULT NULL, price_min INT DEFAULT NULL, price_max INT DEFAULT NULL, frame_sizes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', frame_types LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_tag (search_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_C732C33C650760A9 (search_id), INDEX IDX_C732C33CBAD26311 (tag_id), PRIMARY KEY(search_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_category (search_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_161BB274650760A9 (search_id), INDEX IDX_161BB27412469DE2 (category_id), PRIMARY KEY(search_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, temp_secret_key VARCHAR(255) DEFAULT NULL, secret_key_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494ED07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE search_tag ADD CONSTRAINT FK_C732C33C650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_tag ADD CONSTRAINT FK_C732C33CBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_category ADD CONSTRAINT FK_161BB274650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_category ADD CONSTRAINT FK_161BB27412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advert ADD created_by_id INT DEFAULT NULL, ADD frame_size VARCHAR(255) NOT NULL, ADD fork VARCHAR(255) DEFAULT NULL, ADD material VARCHAR(255) NOT NULL, ADD wheel_size DOUBLE PRECISION NOT NULL, ADD frame_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_54F1F40BB03A8386 ON advert (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE search_tag DROP FOREIGN KEY FK_C732C33C650760A9');
        $this->addSql('ALTER TABLE search_category DROP FOREIGN KEY FK_161BB274650760A9');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BB03A8386');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25B03A8386');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EB03A8386');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE search');
        $this->addSql('DROP TABLE search_tag');
        $this->addSql('DROP TABLE search_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_54F1F40BB03A8386 ON advert');
        $this->addSql('ALTER TABLE advert DROP created_by_id, DROP frame_size, DROP fork, DROP material, DROP wheel_size, DROP frame_type');
    }
}
