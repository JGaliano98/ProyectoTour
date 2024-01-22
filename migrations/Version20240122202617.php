<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122202617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva ADD id_usuario_id INT NOT NULL, ADD id_tour_id INT NOT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BCB702433 FOREIGN KEY (id_tour_id) REFERENCES tour (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B7EB2C349 ON reserva (id_usuario_id)');
        $this->addSql('CREATE INDEX IDX_188D2E3BCB702433 ON reserva (id_tour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B7EB2C349');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BCB702433');
        $this->addSql('DROP INDEX IDX_188D2E3B7EB2C349 ON reserva');
        $this->addSql('DROP INDEX IDX_188D2E3BCB702433 ON reserva');
        $this->addSql('ALTER TABLE reserva DROP id_usuario_id, DROP id_tour_id');
    }
}
