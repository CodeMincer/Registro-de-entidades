<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303105304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compras ADD producto_id INT NOT NULL');
        $this->addSql('ALTER TABLE compras ADD CONSTRAINT FK_3692E1B77645698E FOREIGN KEY (producto_id) REFERENCES productos (id)');
        $this->addSql('CREATE INDEX IDX_3692E1B77645698E ON compras (producto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compras DROP FOREIGN KEY FK_3692E1B77645698E');
        $this->addSql('DROP INDEX IDX_3692E1B77645698E ON compras');
        $this->addSql('ALTER TABLE compras DROP producto_id');
    }
}
