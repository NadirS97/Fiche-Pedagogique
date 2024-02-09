<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324203436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E36F91B382');
        $this->addSql('DROP INDEX IDX_717E22E36F91B382 ON etudiant');
        $this->addSql('ALTER TABLE etudiant ADD parcours_id INT DEFAULT NULL, CHANGE listes_id user_acc_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E379392F33 FOREIGN KEY (user_acc_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E36E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E379392F33 ON etudiant (user_acc_id)');
        $this->addSql('CREATE INDEX IDX_717E22E36E38C0DB ON etudiant (parcours_id)');
        $this->addSql('ALTER TABLE fiche_pedagogique DROP FOREIGN KEY FK_7CFEAB2E6E38C0DB');
        $this->addSql('ALTER TABLE fiche_pedagogique DROP FOREIGN KEY FK_7CFEAB2EE7FB79E8');
        $this->addSql('DROP INDEX IDX_7CFEAB2E6E38C0DB ON fiche_pedagogique');
        $this->addSql('DROP INDEX IDX_7CFEAB2EE7FB79E8 ON fiche_pedagogique');
        $this->addSql('ALTER TABLE fiche_pedagogique ADD transmis TINYINT(1) DEFAULT NULL, ADD deleted TINYINT(1) NOT NULL, DROP parcours_id, DROP ue_parcours_id');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3E7FB79E8');
        $this->addSql('DROP INDEX IDX_99B1DEE3E7FB79E8 ON parcours');
        $this->addSql('ALTER TABLE parcours DROP ue_parcours_id');
        $this->addSql('ALTER TABLE respo ADD respo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE respo ADD CONSTRAINT FK_ED4D90B5DCF84E11 FOREIGN KEY (respo_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ED4D90B5DCF84E11 ON respo (respo_id)');
        $this->addSql('ALTER TABLE secr ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secr ADD CONSTRAINT FK_E609F1D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E609F1D1A76ED395 ON secr (user_id)');
        $this->addSql('ALTER TABLE ue ADD parcours_id INT DEFAULT NULL, ADD ects INT DEFAULT NULL, ADD semestre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9B6E38C0DB ON ue (parcours_id)');
        $this->addSql('ALTER TABLE ue_parcours DROP FOREIGN KEY FK_82440F441218821');
        $this->addSql('DROP INDEX IDX_82440F441218821 ON ue_parcours');
        $this->addSql('ALTER TABLE ue_parcours ADD fiche_pedagogique_id INT DEFAULT NULL, DROP id_ue, DROP id_parcours, DROP ects, CHANGE code_apogee_id ue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ue_parcours ADD CONSTRAINT FK_82440F4462E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE ue_parcours ADD CONSTRAINT FK_82440F444364149F FOREIGN KEY (fiche_pedagogique_id) REFERENCES fiche_pedagogique (id)');
        $this->addSql('CREATE INDEX IDX_82440F4462E883B1 ON ue_parcours (ue_id)');
        $this->addSql('CREATE INDEX IDX_82440F444364149F ON ue_parcours (fiche_pedagogique_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E379392F33');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E36E38C0DB');
        $this->addSql('DROP INDEX UNIQ_717E22E379392F33 ON etudiant');
        $this->addSql('DROP INDEX IDX_717E22E36E38C0DB ON etudiant');
        $this->addSql('ALTER TABLE etudiant ADD listes_id INT DEFAULT NULL, DROP user_acc_id, DROP parcours_id');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E36F91B382 FOREIGN KEY (listes_id) REFERENCES listes (id)');
        $this->addSql('CREATE INDEX IDX_717E22E36F91B382 ON etudiant (listes_id)');
        $this->addSql('ALTER TABLE fiche_pedagogique ADD parcours_id INT DEFAULT NULL, ADD ue_parcours_id INT DEFAULT NULL, DROP transmis, DROP deleted');
        $this->addSql('ALTER TABLE fiche_pedagogique ADD CONSTRAINT FK_7CFEAB2E6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE fiche_pedagogique ADD CONSTRAINT FK_7CFEAB2EE7FB79E8 FOREIGN KEY (ue_parcours_id) REFERENCES ue_parcours (id)');
        $this->addSql('CREATE INDEX IDX_7CFEAB2E6E38C0DB ON fiche_pedagogique (parcours_id)');
        $this->addSql('CREATE INDEX IDX_7CFEAB2EE7FB79E8 ON fiche_pedagogique (ue_parcours_id)');
        $this->addSql('ALTER TABLE parcours ADD ue_parcours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3E7FB79E8 FOREIGN KEY (ue_parcours_id) REFERENCES ue_parcours (id)');
        $this->addSql('CREATE INDEX IDX_99B1DEE3E7FB79E8 ON parcours (ue_parcours_id)');
        $this->addSql('ALTER TABLE respo DROP FOREIGN KEY FK_ED4D90B5DCF84E11');
        $this->addSql('DROP INDEX UNIQ_ED4D90B5DCF84E11 ON respo');
        $this->addSql('ALTER TABLE respo DROP respo_id');
        $this->addSql('ALTER TABLE secr DROP FOREIGN KEY FK_E609F1D1A76ED395');
        $this->addSql('DROP INDEX UNIQ_E609F1D1A76ED395 ON secr');
        $this->addSql('ALTER TABLE secr DROP user_id');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B6E38C0DB');
        $this->addSql('DROP INDEX IDX_2E490A9B6E38C0DB ON ue');
        $this->addSql('ALTER TABLE ue DROP parcours_id, DROP ects, DROP semestre');
        $this->addSql('ALTER TABLE ue_parcours DROP FOREIGN KEY FK_82440F4462E883B1');
        $this->addSql('ALTER TABLE ue_parcours DROP FOREIGN KEY FK_82440F444364149F');
        $this->addSql('DROP INDEX IDX_82440F4462E883B1 ON ue_parcours');
        $this->addSql('DROP INDEX IDX_82440F444364149F ON ue_parcours');
        $this->addSql('ALTER TABLE ue_parcours ADD code_apogee_id INT DEFAULT NULL, ADD id_ue INT NOT NULL, ADD id_parcours INT NOT NULL, ADD ects INT NOT NULL, DROP ue_id, DROP fiche_pedagogique_id');
        $this->addSql('ALTER TABLE ue_parcours ADD CONSTRAINT FK_82440F441218821 FOREIGN KEY (code_apogee_id) REFERENCES ue (id)');
        $this->addSql('CREATE INDEX IDX_82440F441218821 ON ue_parcours (code_apogee_id)');
    }
}
