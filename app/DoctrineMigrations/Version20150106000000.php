<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150106000000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
CREATE TABLE fos_user (
  id INT AUTO_INCREMENT NOT NULL,
  master_hit INT DEFAULT NULL,
  username VARCHAR(255) NOT NULL,
  username_canonical VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  email_canonical VARCHAR(255) NOT NULL,
  enabled TINYINT(1) NOT NULL,
  salt VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  last_login DATETIME DEFAULT NULL,
  locked TINYINT(1) NOT NULL,
  expired TINYINT(1) NOT NULL,
  expires_at DATETIME DEFAULT NULL,
  confirmation_token VARCHAR(255) DEFAULT NULL,
  password_requested_at DATETIME DEFAULT NULL,
  roles LONGTEXT NOT NULL,
  credentials_expired TINYINT(1) NOT NULL,
  credentials_expire_at DATETIME DEFAULT NULL,
  name_first VARCHAR(255) NOT NULL,
  name_last VARCHAR(255) NOT NULL,
  ref_code VARCHAR(255) NOT NULL,
  PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A64796066711F ON fos_user (ref_code)');
        $this->addSql('
CREATE TABLE refcode_hits (
  id INT AUTO_INCREMENT NOT NULL,
  ref_code VARCHAR(255) NOT NULL,
  referrer VARCHAR(255) DEFAULT NULL,
  ip VARCHAR(255) DEFAULT NULL,
  dt DATETIME NOT NULL,
  PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE refcode_hits');
        $this->addSql('DROP TABLE fos_user');
    }
}
