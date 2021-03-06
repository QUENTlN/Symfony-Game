<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306165715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE guest_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_settings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE score_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sub_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76F85E0677 ON admin (username)');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, question_id INT NOT NULL, text_answer TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, game_id INT NOT NULL, lib_category VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19C1E48FD905 ON category (game_id)');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE guest (id INT NOT NULL, pseudo VARCHAR(25) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(100) NOT NULL, is_admin BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, player_id INT NOT NULL, sub_category_id INT NOT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E99E6F5DF ON question (player_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EF7BFE87C ON question (sub_category_id)');
        $this->addSql('CREATE TABLE question_with_picture (id INT NOT NULL, link_picture VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_with_text (id INT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, room_settings_id INT DEFAULT NULL, host_id INT NOT NULL, name VARCHAR(400) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, finished_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_private BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_729F519B4DA136B7 ON room (room_settings_id)');
        $this->addSql('CREATE INDEX IDX_729F519B1FB8D185 ON room (host_id)');
        $this->addSql('CREATE TABLE room_settings (id INT NOT NULL, id_player_id INT DEFAULT NULL, nb_max_player INT NOT NULL, show_score BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, one_answer_only BOOLEAN NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name_profil VARCHAR(255) DEFAULT NULL, number_round INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_45A3600119D349F8 ON room_settings (id_player_id)');
        $this->addSql('CREATE TABLE room_settings_game (room_settings_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(room_settings_id, game_id))');
        $this->addSql('CREATE INDEX IDX_2E78C75D4DA136B7 ON room_settings_game (room_settings_id)');
        $this->addSql('CREATE INDEX IDX_2E78C75DE48FD905 ON room_settings_game (game_id)');
        $this->addSql('CREATE TABLE round (id INT NOT NULL, room_id INT NOT NULL, question_id INT NOT NULL, index_order INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5EEEA3454177093 ON round (room_id)');
        $this->addSql('CREATE INDEX IDX_C5EEEA341E27F6BF ON round (question_id)');
        $this->addSql('CREATE TABLE score (id INT NOT NULL, guest_id INT NOT NULL, room_id INT NOT NULL, score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_329937519A4AA658 ON score (guest_id)');
        $this->addSql('CREATE INDEX IDX_3299375154177093 ON score (room_id)');
        $this->addSql('CREATE TABLE sub_category (id INT NOT NULL, category_id INT NOT NULL, lib_sub_category VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
        $this->addSql('CREATE TABLE sub_category_room_settings (sub_category_id INT NOT NULL, room_settings_id INT NOT NULL, PRIMARY KEY(sub_category_id, room_settings_id))');
        $this->addSql('CREATE INDEX IDX_311C8F00F7BFE87C ON sub_category_room_settings (sub_category_id)');
        $this->addSql('CREATE INDEX IDX_311C8F004DA136B7 ON sub_category_room_settings (room_settings_id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65BF396750 FOREIGN KEY (id) REFERENCES guest (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_with_picture ADD CONSTRAINT FK_8CDC8A28BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_with_text ADD CONSTRAINT FK_E8B61C77BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B4DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B1FB8D185 FOREIGN KEY (host_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room_settings ADD CONSTRAINT FK_45A3600119D349F8 FOREIGN KEY (id_player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room_settings_game ADD CONSTRAINT FK_2E78C75D4DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room_settings_game ADD CONSTRAINT FK_2E78C75DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA3454177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA341E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937519A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375154177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_room_settings ADD CONSTRAINT FK_311C8F00F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category_room_settings ADD CONSTRAINT FK_311C8F004DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT FK_BCE3F79812469DE2');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C1E48FD905');
        $this->addSql('ALTER TABLE room_settings_game DROP CONSTRAINT FK_2E78C75DE48FD905');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65BF396750');
        $this->addSql('ALTER TABLE score DROP CONSTRAINT FK_329937519A4AA658');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E99E6F5DF');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE room DROP CONSTRAINT FK_729F519B1FB8D185');
        $this->addSql('ALTER TABLE room_settings DROP CONSTRAINT FK_45A3600119D349F8');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question_with_picture DROP CONSTRAINT FK_8CDC8A28BF396750');
        $this->addSql('ALTER TABLE question_with_text DROP CONSTRAINT FK_E8B61C77BF396750');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA341E27F6BF');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA3454177093');
        $this->addSql('ALTER TABLE score DROP CONSTRAINT FK_3299375154177093');
        $this->addSql('ALTER TABLE room DROP CONSTRAINT FK_729F519B4DA136B7');
        $this->addSql('ALTER TABLE room_settings_game DROP CONSTRAINT FK_2E78C75D4DA136B7');
        $this->addSql('ALTER TABLE sub_category_room_settings DROP CONSTRAINT FK_311C8F004DA136B7');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EF7BFE87C');
        $this->addSql('ALTER TABLE sub_category_room_settings DROP CONSTRAINT FK_311C8F00F7BFE87C');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE guest_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_settings_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE score_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sub_category_id_seq CASCADE');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_with_picture');
        $this->addSql('DROP TABLE question_with_text');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_settings');
        $this->addSql('DROP TABLE room_settings_game');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE sub_category_room_settings');
    }
}
