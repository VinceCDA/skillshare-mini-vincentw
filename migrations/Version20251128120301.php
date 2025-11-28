<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251128120301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, test VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_skill_offered (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, INDEX IDX_D5EE3F0DA76ED395 (user_id), INDEX IDX_D5EE3F0D5585C142 (skill_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_skill_wanted (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, INDEX IDX_7665902EA76ED395 (user_id), INDEX IDX_7665902E5585C142 (skill_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
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
        $this->addSql('DROP TABLE user_skill_offered');
        $this->addSql('DROP TABLE user_skill_wanted');
    }
}
