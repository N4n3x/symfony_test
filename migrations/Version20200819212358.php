<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819212358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE stock DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE stock ADD magasin_id INT NOT NULL, ADD produit_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566020096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_4B36566020096AE3 ON stock (magasin_id)');
        $this->addSql('CREATE INDEX IDX_4B365660F347EFB ON stock (produit_id)');
        $this->addSql('ALTER TABLE stock ADD PRIMARY KEY (magasin_id, produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566020096AE3');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660F347EFB');
        $this->addSql('DROP INDEX IDX_4B36566020096AE3 ON stock');
        $this->addSql('DROP INDEX IDX_4B365660F347EFB ON stock');
        $this->addSql('ALTER TABLE stock ADD id INT AUTO_INCREMENT NOT NULL, DROP magasin_id, DROP produit_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
