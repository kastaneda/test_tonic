<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150106000000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE fos_user ADD hit_id INT DEFAULT NULL, CHANGE master_hit referrer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479798C22DB FOREIGN KEY (referrer_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479BC1A1241 FOREIGN KEY (hit_id) REFERENCES refcode_hits (id)');
        $this->addSql('CREATE INDEX IDX_957A6479798C22DB ON fos_user (referrer_id)');
        $this->addSql('CREATE INDEX IDX_957A6479BC1A1241 ON fos_user (hit_id)');
        $this->addSql('ALTER TABLE refcode_hits ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE refcode_hits ADD CONSTRAINT FK_84B3850DA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_84B3850DA76ED395 ON refcode_hits (user_id)');
    }

    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479798C22DB');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479BC1A1241');
        $this->addSql('DROP INDEX IDX_957A6479798C22DB ON fos_user');
        $this->addSql('DROP INDEX IDX_957A6479BC1A1241 ON fos_user');
        $this->addSql('ALTER TABLE fos_user ADD master_hit INT DEFAULT NULL, DROP referrer_id, DROP hit_id');
        $this->addSql('ALTER TABLE refcode_hits DROP FOREIGN KEY FK_84B3850DA76ED395');
        $this->addSql('DROP INDEX IDX_84B3850DA76ED395 ON refcode_hits');
        $this->addSql('ALTER TABLE refcode_hits DROP user_id');
    }
}
