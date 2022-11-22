<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20221016182404 extends AbstractMigration
{
    private const USER_TABLE_NAME = 'user';
    private const BLOG_POST_TABLE_NAME = 'blog_post';
    private const BLOG_TAG_TABLE_NAME = 'blog_tag';
    private const POST_TAG_TABLE_NAME = 'post_tag';
    private const POST_OLD_SLUG_TABLE_NAME = 'post_old_slug';

    public function up(Schema $schema): void
    {
        $user = $schema->createTable(name: self::USER_TABLE_NAME);
        $userId = $user->addColumn(name: 'identifier', typeName: Types::BINARY, options: ['notnull' => true, 'comment' => '(DC2Type:ulid)', 'length' => 16]);
        $user->addColumn(name: 'email', typeName: Types::STRING, options: ['notnull' => true, 'length' => 180]);
        $user->addColumn(name: 'roles', typeName: Types::JSON, options: ['notnull' => true]);
        $user->addColumn(name: 'password', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $user->addUniqueIndex(columnNames: ['email']);
        $user->setPrimaryKey(columnNames: [$userId->getName()]);

        $blogPost = $schema->createTable(name: self::BLOG_POST_TABLE_NAME);
        $blogPostId = $blogPost->addColumn(name: 'identifier', typeName: Types::BINARY, options: ['notnull' => true, 'comment' => '(DC2Type:ulid)', 'length' => 16]);
        $blogPost->addColumn(name: 'title', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $blogPost->addColumn(name: 'description', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $blogPost->addColumn(name: 'content', typeName: Types::TEXT, options: ['notnull' => true]);
        $blogPost->addColumn(name: 'slug', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $blogPost->addColumn(name: 'published_at', typeName: Types::DATETIME_MUTABLE, options: ['notnull' => true, 'length' => 255, 'default' => null]);
        $blogPost->addColumn(name: 'updated_at', typeName: Types::DATETIME_MUTABLE, options: ['notnull' => false, 'length' => 255, 'default' => null]);
        $blogPost->addColumn(name: 'user_identifier', typeName: Types::BINARY, options: ['notnull' => false, 'comment' => '(DC2Type:ulid)', 'length' => 16, 'default' => null]);
        $blogPost->setPrimaryKey(columnNames: [$blogPostId->getName()]);
        $blogPost->addForeignKeyConstraint(foreignTable: $user, localColumnNames: ['user_identifier'], foreignColumnNames: ['identifier']);

        $blogTag = $schema->createTable(name: self::BLOG_TAG_TABLE_NAME);
        $blogTagId = $blogTag->addColumn(name: 'identifier', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true]);
        $blogTag->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $blogTag->addColumn(name: 'color', typeName: Types::STRING, options: ['notnull' => true, 'length' => 9]);
        $blogTag->addColumn(name: 'slug', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $blogTag->setPrimaryKey([$blogTagId->getName()]);
        $blogTag->addUniqueIndex(columnNames: ['name']);

        $postTag = $schema->createTable(name: self::POST_TAG_TABLE_NAME);
        $postTagId = $postTag->addColumn(name: 'identifier', typeName: Types::BINARY, options: ['notnull' => true, 'comment' => '(DC2Type:ulid)', 'length' => 16]);
        $postTag->addColumn(name: 'tag_identifier', typeName: Types::INTEGER, options: ['notnull' => true]);
        $postTag->setPrimaryKey(columnNames: [$postTagId->getName(), 'tag_identifier']);
        $postTag->addForeignKeyConstraint(foreignTable: $blogPost, localColumnNames: ['identifier'], foreignColumnNames: ['identifier']);
        $postTag->addForeignKeyConstraint(foreignTable: $blogTag, localColumnNames: ['tag_identifier'], foreignColumnNames: ['identifier']);

        $postOldSlug = $schema->createTable(name: self::POST_OLD_SLUG_TABLE_NAME);
        $postOldSlugId = $postOldSlug->addColumn(name: 'identifier', typeName: Types::BINARY, options: ['notnull' => true, 'comment' => '(DC2Type:ulid)', 'length' => 16]);
        $postOldSlug->addColumn(name: 'post_blog_identifier', typeName: Types::BINARY, options: ['notnull' => false, 'comment' => '(DC2Type:ulid)', 'length' => 16, 'default' => null]);
        $postOldSlug->addColumn(name: 'old_slug', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $postOldSlug->setPrimaryKey(columnNames: [$postOldSlugId->getName()]);
        $postOldSlug->addForeignKeyConstraint(foreignTable: $blogPost, localColumnNames: ['post_blog_identifier'], foreignColumnNames: ['identifier']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(name: self::USER_TABLE_NAME);
        $schema->dropTable(name: self::BLOG_POST_TABLE_NAME);
        $schema->dropTable(name: self::BLOG_TAG_TABLE_NAME);
        $schema->dropTable(name: self::POST_TAG_TABLE_NAME);
        $schema->dropTable(name: self::POST_OLD_SLUG_TABLE_NAME);
    }
}
