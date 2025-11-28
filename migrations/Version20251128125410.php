<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251128125410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, test VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_skill_offered (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, INDEX IDX_D5EE3F0DA76ED395 (user_id), INDEX IDX_D5EE3F0D5585C142 (skill_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_skill_wanted (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, INDEX IDX_7665902EA76ED395 (user_id), INDEX IDX_7665902E5585C142 (skill_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE user_skill_offered ADD CONSTRAINT FK_D5EE3F0DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_skill_offered ADD CONSTRAINT FK_D5EE3F0D5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE user_skill_wanted ADD CONSTRAINT FK_7665902EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_skill_wanted ADD CONSTRAINT FK_7665902E5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_skill_offered DROP FOREIGN KEY FK_D5EE3F0DA76ED395');
        $this->addSql('ALTER TABLE user_skill_offered DROP FOREIGN KEY FK_D5EE3F0D5585C142');
        $this->addSql('ALTER TABLE user_skill_wanted DROP FOREIGN KEY FK_7665902EA76ED395');
        $this->addSql('ALTER TABLE user_skill_wanted DROP FOREIGN KEY FK_7665902E5585C142');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_skill_offered');
        $this->addSql('DROP TABLE user_skill_wanted');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
