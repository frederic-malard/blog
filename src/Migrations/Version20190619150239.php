<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619150239 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, drawing_id INT NOT NULL, photo_id INT DEFAULT NULL, texte_id INT DEFAULT NULL, compo_id INT NOT NULL, created_at DATETIME NOT NULL, value INT NOT NULL, discriminator VARCHAR(255) NOT NULL, INDEX IDX_D8892622F675F31B (author_id), INDEX IDX_D8892622E6552D89 (drawing_id), INDEX IDX_D88926227E9E4C8C (photo_id), INDEX IDX_D8892622EA6DF1F1 (texte_id), INDEX IDX_D8892622F1454301 (compo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622E6552D89 FOREIGN KEY (drawing_id) REFERENCES dessin (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926227E9E4C8C FOREIGN KEY (photo_id) REFERENCES photos (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622EA6DF1F1 FOREIGN KEY (texte_id) REFERENCES texte (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622F1454301 FOREIGN KEY (compo_id) REFERENCES compos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rating');
    }
}
