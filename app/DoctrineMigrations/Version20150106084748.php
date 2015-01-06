<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150106084748 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE refcode_hits ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE refcode_hits ADD CONSTRAINT FK_84B3850DA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_84B3850DA76ED395 ON refcode_hits (user_id)');
        $this->addSql('UPDATE refcode_hits rh LEFT JOIN fos_user fu ON fu.ref_code=rh.ref_code SET rh.user_id=fu.id');
    }

    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE refcode_hits DROP FOREIGN KEY FK_84B3850DA76ED395');
        $this->addSql('ALTER TABLE refcode_hits DROP user_id');
    }
}
