<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190105212403 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_dessin (id INT AUTO_INCREMENT NOT NULL, representant_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C45BFB216C4A52F0 (representant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_dessin_dessin (categorie_dessin_id INT NOT NULL, dessin_id INT NOT NULL, INDEX IDX_1B3DEAE2543F5929 (categorie_dessin_id), INDEX IDX_1B3DEAE2F960562E (dessin_id), PRIMARY KEY(categorie_dessin_id, dessin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_dessin ADD CONSTRAINT FK_C45BFB216C4A52F0 FOREIGN KEY (representant_id) REFERENCES dessin (id)');
        $this->addSql('ALTER TABLE categorie_dessin_dessin ADD CONSTRAINT FK_1B3DEAE2543F5929 FOREIGN KEY (categorie_dessin_id) REFERENCES categorie_dessin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_dessin_dessin ADD CONSTRAINT FK_1B3DEAE2F960562E FOREIGN KEY (dessin_id) REFERENCES dessin (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_dessin_dessin DROP FOREIGN KEY FK_1B3DEAE2543F5929');
        $this->addSql('DROP TABLE categorie_dessin');
        $this->addSql('DROP TABLE categorie_dessin_dessin');
    }
}
