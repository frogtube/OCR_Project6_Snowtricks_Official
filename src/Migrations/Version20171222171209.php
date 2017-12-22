<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171222171209 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(100) NOT NULL, caption VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(100) NOT NULL, CHANGE firstname firstname VARCHAR(100) NOT NULL, CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE password password VARCHAR(20) NOT NULL, CHANGE avatar avatar VARCHAR(100) DEFAULT NULL, CHANGE role role VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE firstname firstname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE lastname lastname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE password password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE role role VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
