<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150106123114 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE fos_user CHANGE master_hit hit_id INT DEFAULT NULL');
        if ($this->connection->getDatabasePlatform()->getName() == 'mysql') {
            $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479BC1A1241 FOREIGN KEY (hit_id) REFERENCES refcode_hits (id)');
        }
        $this->addSql('CREATE INDEX IDX_957A6479BC1A1241 ON fos_user (hit_id)');
        $this->addSql('ALTER TABLE fos_user ADD referrer_id INT DEFAULT NULL');
        if ($this->connection->getDatabasePlatform()->getName() == 'mysql') {
            $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479798C22DB FOREIGN KEY (referrer_id) REFERENCES fos_user (id)');
        }
        $this->addSql('CREATE INDEX IDX_957A6479798C22DB ON fos_user (referrer_id)');
        $this->addSql('UPDATE fos_user fu LEFT JOIN refcode_hits rh ON rh.id=fu.hit_id SET fu.referrer_id=rh.user_id');
    }

    public function down(Schema $schema)
    {
        if ($this->connection->getDatabasePlatform()->getName() == 'mysql') {
            $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479798C22DB');
        }
        $this->addSql('ALTER TABLE fos_user DROP referrer_id');
        if ($this->connection->getDatabasePlatform()->getName() == 'mysql') {
            $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479BC1A1241');
        }
        $this->addSql('ALTER TABLE fos_user CHANGE hit_id master_hit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user DROP INDEX IDX_957A6479BC1A1241');
    }
}
