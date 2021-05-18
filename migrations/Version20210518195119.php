<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518195119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointments (id INT AUTO_INCREMENT NOT NULL, customer_id_id INT NOT NULL, INDEX IDX_6A41727AB171EB6C (customer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, hour TIME NOT NULL, slot INT NOT NULL, state VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, appointment_id_id INT NOT NULL, service_id_id INT NOT NULL, slot_id_id INT NOT NULL, INDEX IDX_E52FFDEE9334AFB9 (appointment_id_id), INDEX IDX_E52FFDEED63673B0 (service_id_id), INDEX IDX_E52FFDEE11F1B11A (slot_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727AB171EB6C FOREIGN KEY (customer_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9334AFB9 FOREIGN KEY (appointment_id_id) REFERENCES appointments (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEED63673B0 FOREIGN KEY (service_id_id) REFERENCES service_list (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE11F1B11A FOREIGN KEY (slot_id_id) REFERENCES calendar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9334AFB9');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE11F1B11A');
        $this->addSql('DROP TABLE appointments');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE orders');
    }
}
