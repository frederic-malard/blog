<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125150013 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_web_competence_app_web (app_web_id INT NOT NULL, competence_app_web_id INT NOT NULL, INDEX IDX_553114FF1B1B2ACD (app_web_id), INDEX IDX_553114FF359B923A (competence_app_web_id), PRIMARY KEY(app_web_id, competence_app_web_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_app_web (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_web_competence_app_web ADD CONSTRAINT FK_553114FF1B1B2ACD FOREIGN KEY (app_web_id) REFERENCES app_web (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_web_competence_app_web ADD CONSTRAINT FK_553114FF359B923A FOREIGN KEY (competence_app_web_id) REFERENCES competence_app_web (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_web_competence_app_web DROP FOREIGN KEY FK_553114FF359B923A');
        $this->addSql('DROP TABLE app_web_competence_app_web');
        $this->addSql('DROP TABLE competence_app_web');
    }
}
