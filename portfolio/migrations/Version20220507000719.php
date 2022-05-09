<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20220507000719 extends AbstractMigration
{
    private const USER_TABLE_NAME = 'user';
    private const TECHNOLOGY_TABLE_NAME = 'technology';
    private const POST_TABLE_NAME = 'post';


    public function up(Schema $schema): void
    {
        $user = $schema->createTable(name: self::USER_TABLE_NAME);
        $userIdentifier = $user->addColumn(name: 'identifier', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement'=> true, 'length' => 16]);
        $user->addColumn(name: 'email', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 180]);
        $user->addColumn(name: 'roles', typeName: Types::JSON, options:  ['notnull' => true]);
        $user->addColumn(name: 'password', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 255]);
        $user->setPrimaryKey([$userIdentifier->getName()]);
        $user->addUniqueConstraint(['email']);

        $technology = $schema->createTable(name: self::TECHNOLOGY_TABLE_NAME);
        $technologyIdentifier = $technology->addColumn(name: 'identifier', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement'=> true, 'length' => 16]);
        $technology->addColumn(name: 'name', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 180]);
        $technology->addColumn(name: 'color', typeName: Types::STRING, options:  ['notnull' => false, 'default' => null, 'length' => 7]);
        $technology->addColumn(name: 'slug', typeName: Types::STRING, options:  ['notnull' => false, 'default' => null, 'length' => 255]);
        $technology->setPrimaryKey([$technologyIdentifier->getName()]);

        $post = $schema->createTable(name: self::POST_TABLE_NAME);
        $postIdentifier = $post->addColumn(name: 'identifier', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement'=> true, 'length' => 16]);
        $post->addColumn(name: 'user_identifier', typeName: Types::INTEGER, options: ['notnull' => false, 'default' => null, 'length' => 16]);
        $post->addColumn(name: 'technology_identifier', typeName: Types::INTEGER, options: ['notnull' => false, 'default' => null, 'length' => 16]);
        $post->addColumn(name: 'title', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 180]);
        $post->addColumn(name: 'description', typeName: Types::STRING, options:  ['notnull' => true, 'length' => 180]);
        $post->addColumn(name: 'content', typeName: Types::TEXT, options:  ['notnull' => true]);
        $post->addColumn(name: 'create_at', typeName: Types::DATETIME_MUTABLE, options:  ['notnull' => true]);
        $post->addColumn(name: 'update_at', typeName: Types::DATETIME_MUTABLE, options:  ['notnull' => false, 'default' => null]);
        $post->addColumn(name: 'slug', typeName: Types::STRING, options:  ['notnull' => false, 'default' => null, 'length' => 255]);
        $post->addForeignKeyConstraint(foreignTable: $user, localColumnNames: ['user_identifier'], foreignColumnNames: ['identifier']);
        $post->addForeignKeyConstraint(foreignTable: $technology, localColumnNames: ['technology_identifier'], foreignColumnNames: ['identifier']);

        $post->setPrimaryKey([$postIdentifier->getName()]);

    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(name: self::USER_TABLE_NAME);
        $schema->dropTable(name: self::TECHNOLOGY_TABLE_NAME);
        $schema->dropTable(name: self::POST_TABLE_NAME);
    }
}
