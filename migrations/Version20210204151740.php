<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204151740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usuarios_posteos (usuario_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_4FB02378DB38439E (usuario_id), UNIQUE INDEX UNIQ_4FB023784B89032C (post_id), PRIMARY KEY(usuario_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuarios_posteos ADD CONSTRAINT FK_4FB02378DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuarios_posteos ADD CONSTRAINT FK_4FB023784B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DDB38439E');
        $this->addSql('DROP INDEX IDX_5A8A6C8DDB38439E ON post');
        $this->addSql('ALTER TABLE post DROP usuario_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE usuarios_posteos');
        $this->addSql('ALTER TABLE post ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DDB38439E ON post (usuario_id)');
    }
}
