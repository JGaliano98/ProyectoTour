<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122204749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_ruta (item_id INT NOT NULL, ruta_id INT NOT NULL, INDEX IDX_B9EB477126F525E (item_id), INDEX IDX_B9EB477ABBC4845 (ruta_id), PRIMARY KEY(item_id, ruta_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ruta_item (ruta_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_837FEAD6ABBC4845 (ruta_id), INDEX IDX_837FEAD6126F525E (item_id), PRIMARY KEY(ruta_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_ruta ADD CONSTRAINT FK_B9EB477126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_ruta ADD CONSTRAINT FK_B9EB477ABBC4845 FOREIGN KEY (ruta_id) REFERENCES ruta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ruta_item ADD CONSTRAINT FK_837FEAD6ABBC4845 FOREIGN KEY (ruta_id) REFERENCES ruta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ruta_item ADD CONSTRAINT FK_837FEAD6126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE informe ADD id_tour_id INT NOT NULL');
        $this->addSql('ALTER TABLE informe ADD CONSTRAINT FK_7E75E1D9CB702433 FOREIGN KEY (id_tour_id) REFERENCES tour (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E75E1D9CB702433 ON informe (id_tour_id)');
        $this->addSql('ALTER TABLE ruta ADD id_localidad_id INT NOT NULL');
        $this->addSql('ALTER TABLE ruta ADD CONSTRAINT FK_C3AEF08C44B109FB FOREIGN KEY (id_localidad_id) REFERENCES localidad (id)');
        $this->addSql('CREATE INDEX IDX_C3AEF08C44B109FB ON ruta (id_localidad_id)');
        $this->addSql('ALTER TABLE tour ADD id_ruta_id INT NOT NULL, ADD id_usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE tour ADD CONSTRAINT FK_6AD1F9697521E135 FOREIGN KEY (id_ruta_id) REFERENCES ruta (id)');
        $this->addSql('ALTER TABLE tour ADD CONSTRAINT FK_6AD1F9697EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_6AD1F9697521E135 ON tour (id_ruta_id)');
        $this->addSql('CREATE INDEX IDX_6AD1F9697EB2C349 ON tour (id_usuario_id)');
        $this->addSql('ALTER TABLE valoraciones ADD id_reserva_id INT NOT NULL, ADD id_tour_id INT NOT NULL');
        $this->addSql('ALTER TABLE valoraciones ADD CONSTRAINT FK_4085066773FBB93F FOREIGN KEY (id_reserva_id) REFERENCES reserva (id)');
        $this->addSql('ALTER TABLE valoraciones ADD CONSTRAINT FK_40850667CB702433 FOREIGN KEY (id_tour_id) REFERENCES tour (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4085066773FBB93F ON valoraciones (id_reserva_id)');
        $this->addSql('CREATE INDEX IDX_40850667CB702433 ON valoraciones (id_tour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_ruta DROP FOREIGN KEY FK_B9EB477126F525E');
        $this->addSql('ALTER TABLE item_ruta DROP FOREIGN KEY FK_B9EB477ABBC4845');
        $this->addSql('ALTER TABLE ruta_item DROP FOREIGN KEY FK_837FEAD6ABBC4845');
        $this->addSql('ALTER TABLE ruta_item DROP FOREIGN KEY FK_837FEAD6126F525E');
        $this->addSql('DROP TABLE item_ruta');
        $this->addSql('DROP TABLE ruta_item');
        $this->addSql('ALTER TABLE informe DROP FOREIGN KEY FK_7E75E1D9CB702433');
        $this->addSql('DROP INDEX UNIQ_7E75E1D9CB702433 ON informe');
        $this->addSql('ALTER TABLE informe DROP id_tour_id');
        $this->addSql('ALTER TABLE ruta DROP FOREIGN KEY FK_C3AEF08C44B109FB');
        $this->addSql('DROP INDEX IDX_C3AEF08C44B109FB ON ruta');
        $this->addSql('ALTER TABLE ruta DROP id_localidad_id');
        $this->addSql('ALTER TABLE valoraciones DROP FOREIGN KEY FK_4085066773FBB93F');
        $this->addSql('ALTER TABLE valoraciones DROP FOREIGN KEY FK_40850667CB702433');
        $this->addSql('DROP INDEX UNIQ_4085066773FBB93F ON valoraciones');
        $this->addSql('DROP INDEX IDX_40850667CB702433 ON valoraciones');
        $this->addSql('ALTER TABLE valoraciones DROP id_reserva_id, DROP id_tour_id');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F9697521E135');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F9697EB2C349');
        $this->addSql('DROP INDEX IDX_6AD1F9697521E135 ON tour');
        $this->addSql('DROP INDEX IDX_6AD1F9697EB2C349 ON tour');
        $this->addSql('ALTER TABLE tour DROP id_ruta_id, DROP id_usuario_id');
    }
}
