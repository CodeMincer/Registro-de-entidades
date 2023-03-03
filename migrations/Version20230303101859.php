<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303101859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, telefono VARCHAR(9) NOT NULL, email VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compras (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, metodo_id INT NOT NULL, INDEX IDX_3692E1B7DE734E51 (cliente_id), INDEX IDX_3692E1B7A45CBFCF (metodo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flores (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metodos (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productos (id INT AUTO_INCREMENT NOT NULL, tipo_flores_id INT DEFAULT NULL, compras_id INT NOT NULL, tipo VARCHAR(255) NOT NULL, precio VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_767490E626169D91 (tipo_flores_id), INDEX IDX_767490E6FF341D56 (compras_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compras ADD CONSTRAINT FK_3692E1B7DE734E51 FOREIGN KEY (cliente_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE compras ADD CONSTRAINT FK_3692E1B7A45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodos (id)');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E626169D91 FOREIGN KEY (tipo_flores_id) REFERENCES flores (id)');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E6FF341D56 FOREIGN KEY (compras_id) REFERENCES compras (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compras DROP FOREIGN KEY FK_3692E1B7DE734E51');
        $this->addSql('ALTER TABLE compras DROP FOREIGN KEY FK_3692E1B7A45CBFCF');
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E626169D91');
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E6FF341D56');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE compras');
        $this->addSql('DROP TABLE flores');
        $this->addSql('DROP TABLE metodos');
        $this->addSql('DROP TABLE productos');
    }
}
