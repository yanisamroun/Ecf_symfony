<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716135832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_genre (book_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_8D92268116A2B381 (book_id), INDEX IDX_8D9226814296D31F (genre_id), PRIMARY KEY(book_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D92268116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D9226814296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('ALTER TABLE borrow ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B016A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_55DBA8B016A2B381 ON borrow (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book_genre');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B ON book');
        $this->addSql('ALTER TABLE book DROP author_id');
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B016A2B381');
        $this->addSql('DROP INDEX IDX_55DBA8B016A2B381 ON borrow');
        $this->addSql('ALTER TABLE borrow DROP book_id');
    }
}
