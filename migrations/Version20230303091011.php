<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303091011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, metodo_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, telefono VARCHAR(9) NOT NULL, email VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, INDEX IDX_50FE07D7A45CBFCF (metodo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flores (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metodos (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productos (id INT AUTO_INCREMENT NOT NULL, clientes_id INT NOT NULL, tipo_flores_id INT NOT NULL, tipo VARCHAR(255) NOT NULL, precio VARCHAR(255) NOT NULL, INDEX IDX_767490E6FBC3AF09 (clientes_id), UNIQUE INDEX UNIQ_767490E626169D91 (tipo_flores_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clientes ADD CONSTRAINT FK_50FE07D7A45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodos (id)');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E6FBC3AF09 FOREIGN KEY (clientes_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E626169D91 FOREIGN KEY (tipo_flores_id) REFERENCES flores (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clientes DROP FOREIGN KEY FK_50FE07D7A45CBFCF');
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E6FBC3AF09');
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E626169D91');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE flores');
        $this->addSql('DROP TABLE metodos');
        $this->addSql('DROP TABLE productos');
    }
}
