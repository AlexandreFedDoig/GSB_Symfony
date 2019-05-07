<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328092717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composant CHANGE CMP_CODE CMP_CODE VARCHAR(4) NOT NULL');
        $this->addSql('ALTER TABLE dosage CHANGE DOS_CODE DOS_CODE VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE famille CHANGE FAM_CODE FAM_CODE VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE labo CHANGE LAB_CODE LAB_CODE VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE medicament CHANGE MED_DEPOTLEGAL MED_DEPOTLEGAL VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE praticien CHANGE PRA_NUM PRA_NUM INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE presentation CHANGE PRE_CODE PRE_CODE VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE rapport_visite CHANGE RAP_NUM RAP_NUM INT NOT NULL');
        $this->addSql('ALTER TABLE region CHANGE REG_CODE REG_CODE VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE secteur CHANGE SEC_CODE SEC_CODE VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE specialite CHANGE SPE_CODE SPE_CODE VARCHAR(5) NOT NULL');
        $this->addSql('ALTER TABLE switchboard items CHANGE ItemNumber ItemNumber INT NOT NULL');
        $this->addSql('ALTER TABLE travailler DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE travailler ADD PRIMARY KEY (VIS_MATRICULE, JJMMAA, REG_CODE)');
        $this->addSql('ALTER TABLE type_individu CHANGE TIN_CODE TIN_CODE VARCHAR(5) NOT NULL');
        $this->addSql('ALTER TABLE type_praticien CHANGE TYP_CODE TYP_CODE VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE visiteur CHANGE VIS_MATRICULE VIS_MATRICULE VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE composant CHANGE CMP_CODE CMP_CODE VARCHAR(4) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE dosage CHANGE DOS_CODE DOS_CODE VARCHAR(10) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE famille CHANGE FAM_CODE FAM_CODE VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE labo CHANGE LAB_CODE LAB_CODE VARCHAR(2) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE medicament CHANGE MED_DEPOTLEGAL MED_DEPOTLEGAL VARCHAR(10) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE praticien CHANGE PRA_NUM PRA_NUM INT NOT NULL');
        $this->addSql('ALTER TABLE presentation CHANGE PRE_CODE PRE_CODE VARCHAR(2) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE rapport_visite CHANGE RAP_NUM RAP_NUM INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE region CHANGE REG_CODE REG_CODE VARCHAR(2) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE secteur CHANGE SEC_CODE SEC_CODE VARCHAR(1) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE specialite CHANGE SPE_CODE SPE_CODE VARCHAR(5) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE switchboard items CHANGE ItemNumber ItemNumber INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE travailler DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE travailler ADD PRIMARY KEY (JJMMAA, VIS_MATRICULE, REG_CODE)');
        $this->addSql('ALTER TABLE type_individu CHANGE TIN_CODE TIN_CODE VARCHAR(5) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE type_praticien CHANGE TYP_CODE TYP_CODE VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE visiteur CHANGE VIS_MATRICULE VIS_MATRICULE VARCHAR(10) NOT NULL COLLATE utf8_general_ci');
    }
}
