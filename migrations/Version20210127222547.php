<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127222547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_guest (room_id INT NOT NULL, guest_id INT NOT NULL, INDEX IDX_E60B3B9E54177093 (room_id), INDEX IDX_E60B3B9E9A4AA658 (guest_id), PRIMARY KEY(room_id, guest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_settings_sub_theme (room_settings_id INT NOT NULL, sub_theme_id INT NOT NULL, INDEX IDX_B7FD72874DA136B7 (room_settings_id), INDEX IDX_B7FD7287E3AD9ADE (sub_theme_id), PRIMARY KEY(room_settings_id, sub_theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_guest ADD CONSTRAINT FK_E60B3B9E54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_guest ADD CONSTRAINT FK_E60B3B9E9A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_settings_sub_theme ADD CONSTRAINT FK_B7FD72874DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_settings_sub_theme ADD CONSTRAINT FK_B7FD7287E3AD9ADE FOREIGN KEY (sub_theme_id) REFERENCES sub_theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer ADD player_id INT NOT NULL, ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A2599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A2599E6F5DF ON answer (player_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('ALTER TABLE category ADD guess_the_id INT NOT NULL, ADD quiz_id INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1DC1EA18 FOREIGN KEY (guess_the_id) REFERENCES guess_the (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1DC1EA18 ON category (guess_the_id)');
        $this->addSql('CREATE INDEX IDX_64C19C1853CD175 ON category (quiz_id)');
        $this->addSql('ALTER TABLE game ADD room_settings_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C4DA136B7 FOREIGN KEY (room_settings_id) REFERENCES room_settings (id)');
        $this->addSql('CREATE INDEX IDX_232B318C4DA136B7 ON game (room_settings_id)');
        $this->addSql('ALTER TABLE guess_the ADD id_game INT NOT NULL');
        $this->addSql('ALTER TABLE player ADD id_guest INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD player_id INT NOT NULL, ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E99E6F5DF ON question (player_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6F7494E12469DE2 ON question (category_id)');
        $this->addSql('ALTER TABLE quiz ADD id_game INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD player_id INT NOT NULL, ADD is_private TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_729F519B99E6F5DF ON room (player_id)');
        $this->addSql('ALTER TABLE sub_theme ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE sub_theme ADD CONSTRAINT FK_7B3183B112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_7B3183B112469DE2 ON sub_theme (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE room_guest');
        $this->addSql('DROP TABLE room_settings_sub_theme');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2599E6F5DF');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('DROP INDEX IDX_DADD4A2599E6F5DF ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A251E27F6BF ON answer');
        $this->addSql('ALTER TABLE answer DROP player_id, DROP question_id');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1DC1EA18');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1853CD175');
        $this->addSql('DROP INDEX IDX_64C19C1DC1EA18 ON category');
        $this->addSql('DROP INDEX IDX_64C19C1853CD175 ON category');
        $this->addSql('ALTER TABLE category DROP guess_the_id, DROP quiz_id');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C4DA136B7');
        $this->addSql('DROP INDEX IDX_232B318C4DA136B7 ON game');
        $this->addSql('ALTER TABLE game DROP room_settings_id');
        $this->addSql('ALTER TABLE guess_the DROP id_game');
        $this->addSql('ALTER TABLE player DROP id_guest');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E99E6F5DF');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E12469DE2');
        $this->addSql('DROP INDEX IDX_B6F7494E99E6F5DF ON question');
        $this->addSql('DROP INDEX UNIQ_B6F7494E12469DE2 ON question');
        $this->addSql('ALTER TABLE question DROP player_id, DROP category_id');
        $this->addSql('ALTER TABLE quiz DROP id_game');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B99E6F5DF');
        $this->addSql('DROP INDEX IDX_729F519B99E6F5DF ON room');
        $this->addSql('ALTER TABLE room DROP player_id, DROP is_private');
        $this->addSql('ALTER TABLE sub_theme DROP FOREIGN KEY FK_7B3183B112469DE2');
        $this->addSql('DROP INDEX IDX_7B3183B112469DE2 ON sub_theme');
        $this->addSql('ALTER TABLE sub_theme DROP category_id');
    }
}
