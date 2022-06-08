<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20220507000719 extends AbstractMigration
{
    private const USER_TABLE_NAME = 'user';
    private const TAG_TABLE_NAME = 'blog_tag';
    private const POST_TABLE_NAME = 'blog_post';
    private const POST_TAG_TABLE_NAME = 'post_tag';


    public function up(Schema $schema): void
    {
        $user = $schema->createTable(name: self::USER_TABLE_NAME);
        $userIdentifier = $user->addColumn(name: 'identifier', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement'=> true, 'length' => 16]);
        $user->addColumn(name: 'email', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 180]);
        $user->addColumn(name: 'roles', typeName: Types::JSON, options:  ['notnull' => true]);
        $user->addColumn(name: 'password', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 255]);
        $user->setPrimaryKey([$userIdentifier->getName()]);
        $user->addUniqueConstraint(['email']);

        $blogPost = $schema->createTable(name: self::POST_TABLE_NAME);
        $blogPost->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement'=> true, 'length' => 16]);
        $blogPost->addColumn(name: 'title', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 255]);
        $blogPost->addColumn(name: 'slug', typeName: Types::STRING, options:  ['notnull' => false, 'default' => null, 'length' => 255]);
        $blogPost->addColumn(name: 'description', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 255]);
        $blogPost->addColumn(name: 'content', typeName: Types::TEXT, options:  ['notnull' => true]);
        $blogPost->addColumn(name: 'published_at', typeName: Types::DATETIME_MUTABLE, options:  ['notnull' => true]);
        $blogPost->addColumn(name: 'updated_at', typeName: Types::DATETIME_MUTABLE, options:  ['notnull' => false, 'default' => null]);
        $blogPost->addColumn(name: 'user_identifier', typeName: Types::INTEGER, options: ['notnull' => false, 'default' => null]);
        $blogPost->addForeignKeyConstraint(foreignTable: $user, localColumnNames: ['user_identifier'], foreignColumnNames: ['identifier']);
        $blogPost->setPrimaryKey(['id']);

        $blogTag = $schema->createTable(name: self::TAG_TABLE_NAME);
        $blogTag->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement'=> true, 'length' => 16]);
        $blogTag->addColumn(name: 'name', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 255]);
        $blogTag->addColumn(name: 'color', typeName: Types::STRING, options:  ['notnull' => false, 'default' => null, 'length' => 9]);
        $blogTag->addColumn(name: 'slug', typeName: Types::STRING, options:  ['notnull' => false, 'default' => null, 'length' => 255]);
        $blogTag->setPrimaryKey(['id']);
        $blogTag->addUniqueConstraint(['name']);

        $blogPostTag = $schema->createTable(name: self::POST_TAG_TABLE_NAME);
        $postId = $blogPostTag->addColumn(name: 'post_id', typeName: Types::INTEGER, options: ['notnull' => true]);
        $tagId = $blogPostTag->addColumn(name: 'tag_id', typeName: Types::INTEGER, options: ['notnull' => true]);
        $blogPostTag->addForeignKeyConstraint(foreignTable: $blogPost, localColumnNames: ['post_id'], foreignColumnNames: ['id'], options: ['onDelete' => 'CASCADE']);
        $blogPostTag->addForeignKeyConstraint(foreignTable: $blogTag, localColumnNames: ['tag_id'], foreignColumnNames: ['id'], options: ['onDelete' => 'CASCADE']);
        $blogPostTag->setPrimaryKey([$postId->getName(), $tagId->getName()]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(name: self::USER_TABLE_NAME);
        $schema->dropTable(name: self::TAG_TABLE_NAME);
        $schema->dropTable(name: self::POST_TABLE_NAME);
    }
}
