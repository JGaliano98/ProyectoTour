<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122193907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE informe (id INT AUTO_INCREMENT NOT NULL, observaciones VARCHAR(255) NOT NULL, dinero NUMERIC(2, 2) DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, fecha DATETIME NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_inicio DATETIME NOT NULL, fecha_fin DATETIME NOT NULL, plazas INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valoraciones (id INT AUTO_INCREMENT NOT NULL, estrellas INT NOT NULL, comentario VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E0106DB054DD');
        $this->addSql('DROP INDEX IDX_4F68E0106DB054DD ON localidad');
        $this->addSql('ALTER TABLE localidad CHANGE provincia_id id_provincia_id INT NOT NULL');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E0106DB054DD FOREIGN KEY (id_provincia_id) REFERENCES provincia (id)');
        $this->addSql('CREATE INDEX IDX_4F68E0106DB054DD ON localidad (id_provincia_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE informe');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE tour');
        $this->addSql('DROP TABLE valoraciones');
        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E0106DB054DD');
        $this->addSql('DROP INDEX IDX_4F68E0106DB054DD ON localidad');
        $this->addSql('ALTER TABLE localidad CHANGE id_provincia_id provincia_id INT NOT NULL');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E0106DB054DD FOREIGN KEY (provincia_id) REFERENCES provincia (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4F68E0106DB054DD ON localidad (provincia_id)');
    }
}
