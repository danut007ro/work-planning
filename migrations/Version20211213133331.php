<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211213133331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial schema setup';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE shift_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE worker_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE worker_shift_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE shift (id INT NOT NULL, name VARCHAR(255) NOT NULL, start_hour INT NOT NULL, end_hour INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE worker (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE worker_shift (id INT NOT NULL, worker_id INT NOT NULL, shift_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B9AC9F916B20BA36 ON worker_shift (worker_id)');
        $this->addSql('CREATE INDEX IDX_B9AC9F91BB70BC0E ON worker_shift (shift_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9AC9F91AA9E377A6B20BA36 ON worker_shift (date, worker_id)');
        $this->addSql('COMMENT ON COLUMN worker_shift.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE worker_shift ADD CONSTRAINT FK_B9AC9F916B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker_shift ADD CONSTRAINT FK_B9AC9F91BB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE worker_shift DROP CONSTRAINT FK_B9AC9F91BB70BC0E');
        $this->addSql('ALTER TABLE worker_shift DROP CONSTRAINT FK_B9AC9F916B20BA36');
        $this->addSql('DROP SEQUENCE shift_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE worker_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE worker_shift_id_seq CASCADE');
        $this->addSql('DROP TABLE shift');
        $this->addSql('DROP TABLE worker');
        $this->addSql('DROP TABLE worker_shift');
    }
}
