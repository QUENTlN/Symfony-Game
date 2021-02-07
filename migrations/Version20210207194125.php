<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207194125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, text_answer LONGTEXT DEFAULT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, lib_category VARCHAR(255) NOT NULL, INDEX IDX_64C19C1E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guess_the (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(25) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(100) NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, sub_category_id INT NOT NULL, text_question LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E99E6F5DF (player_id), INDEX IDX_B6F7494EF7BFE87C (sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_with_picture (id INT NOT NULL, link_picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, room_settings_id INT DEFAULT NULL, host_id INT NOT NULL, name VARCHAR(400) NOT NULL, created_at DATETIME NOT NULL, finished_at DATETIME DEFAULT NULL, is_private TINYINT(1) NOT NULL, INDEX IDX_729F519B4DA136B7 (room_settings_id), INDEX IDX_729F519B1FB8D185 (host_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_settings (id INT AUTO_INCREMENT NOT NULL, id_player_id INT DEFAULT NULL, nb_max_player INT NOT NULL, show_score TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, one_answer_only TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL, name_profil VARCHAR(255) DEFAULT NULL, number_round INT NOT NULL, INDEX IDX_45A3600119D349F8 (id_player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_settings_game (room_settings_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_2E78C75D4DA136B7 (room_settings_id), INDEX IDX_2E78C75DE48FD905 (game_id), PRIMARY KEY(room_settings_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE round (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, question_id INT NOT NULL, index_order INT NOT NULL, INDEX IDX_C5EEEA3454177093 (room_id), INDEX IDX_C5EEEA341E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, guest_id INT NOT NULL, room_id INT NOT NULL, score INT NOT NULL, INDEX IDX_329937519A4AA658 (guest_id), INDEX IDX_3299375154177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, lib_sub_category VARCHAR(255) NOT NULL, INDEX IDX_BCE3F79812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category_room_settings (sub_category_id INT NOT NULL, room_settings_id INT NOT NULL, INDEX IDX_311C8F00F7BFE87C (sub_category_id), INDEX IDX_311C8F004DA136B7 (room_settings_id), PRIMARY KEY(sub_category_id, room_settings_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE guess_the ADD CONSTRAINT FK_809B4A05BF396750 FOREIGN KEY (id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65BF396750 FOREIGN KEY (id) REFERENCES guest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE question_with_picture ADD CONSTRAINT FK_8CDC8A28BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92BF396750 FOREIGN KEY (id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B4DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B1FB8D185 FOREIGN KEY (host_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE room_settings ADD CONSTRAINT FK_45A3600119D349F8 FOREIGN KEY (id_player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE room_settings_game ADD CONSTRAINT FK_2E78C75D4DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_settings_game ADD CONSTRAINT FK_2E78C75DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA3454177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA341E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937519A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375154177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE sub_category_room_settings ADD CONSTRAINT FK_311C8F00F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_category_room_settings ADD CONSTRAINT FK_311C8F004DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1E48FD905');
        $this->addSql('ALTER TABLE guess_the DROP FOREIGN KEY FK_809B4A05BF396750');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92BF396750');
        $this->addSql('ALTER TABLE room_settings_game DROP FOREIGN KEY FK_2E78C75DE48FD905');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65BF396750');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937519A4AA658');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E99E6F5DF');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B1FB8D185');
        $this->addSql('ALTER TABLE room_settings DROP FOREIGN KEY FK_45A3600119D349F8');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question_with_picture DROP FOREIGN KEY FK_8CDC8A28BF396750');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA341E27F6BF');
        $this->addSql('ALTER TABLE round DROP FOREIGN KEY FK_C5EEEA3454177093');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_3299375154177093');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B4DA136B7');
        $this->addSql('ALTER TABLE room_settings_game DROP FOREIGN KEY FK_2E78C75D4DA136B7');
        $this->addSql('ALTER TABLE sub_category_room_settings DROP FOREIGN KEY FK_311C8F004DA136B7');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF7BFE87C');
        $this->addSql('ALTER TABLE sub_category_room_settings DROP FOREIGN KEY FK_311C8F00F7BFE87C');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE guess_the');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_with_picture');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_settings');
        $this->addSql('DROP TABLE room_settings_game');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE sub_category_room_settings');
    }
}
