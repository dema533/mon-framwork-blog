<?php

use PHPUnit\Framework\TestCase;

final class QueryBuilderTest extends TestCase
{

    public function getBuilder(): \App\QueryBuilder
    {
        return new \App\QueryBuilder();
    }

    public function getPDO(): PDO
    {
        $pdo = new PDO("sqlite::memory:");
        $pdo->query('CREATE TABLE post (
    id INTEGER primary key autoincrement,
    title TEXT,
    content TEXT,
    published_at DATETIME,
    created_at DATETIME,
    updated_at DATETIME)');
        for ($i = 1; $i <= 10; $i++) {
            $pdo->exec("INSERT INTO post (title, content, published_at, created_at,updated_at) VALUES ('title $i', 'content $i', '12/$i/2022','15/$i/2022','19/$i/2022');");
        }
        return $pdo;
    }

    public function testSimpleQuery()
    {
        $q = $this->getBuilder()->from("user", "u")->toSQL();
        $this->assertEquals("SELECT * FROM user u", $q);
    }

    public function testOrderBy()
    {
        $q = $this->getBuilder()->from("user", "u")->orderBy("id", "DESC")->toSQL();
        $this->assertEquals("SELECT * FROM user u ORDER BY id DESC", $q);
    }

    public function testMultipleOrderBy()
    {
        $q = $this->getBuilder()
            ->from("user")
            ->orderBy("id", "ezaearz")
            ->orderBy("username", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM user ORDER BY id, name DESC", $q);
    }

    public function testLimit()
    {
        $q = $this->getBuilder()
            ->from("user")
            ->limit(10)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM user ORDER BY id DESC LIMIT 10", $q);
    }

    public function testOffset()
    {
        $q = $this->getBuilder()
            ->from("user")
            ->limit(10)
            ->offset(3)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM user ORDER BY id DESC LIMIT 10 OFFSET 3", $q);
    }

    public function testPage()
    {
        $q = $this->getBuilder()
            ->from("user")
            ->limit(10)
            ->page(3)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM user ORDER BY id DESC LIMIT 10 OFFSET 20", $q);
        $q = $this->getBuilder()
            ->from("user")
            ->limit(10)
            ->page(1)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM user ORDER BY id DESC LIMIT 10 OFFSET 0", $q);
    }

    public function testCondition()
    {
        $q = $this->getBuilder()
            ->from("user")
            ->where("id > :id")
            ->setParam("id", 3)
            ->limit(10)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM user WHERE id > :id ORDER BY id DESC LIMIT 10", $q);
    }

    public function testSelect()
    {
        $q = $this->getBuilder()
            ->select("id", "title", "content")
            ->from("post");
        $this->assertEquals("SELECT id, title, content FROM post", $q->toSQL());
    }

    public function testSelectMultiple()
    {
        $q = $this->getBuilder()
            ->select("id", "username")
            ->from("user")
            ->select('title');
        $this->assertEquals("SELECT id, title, content FROM post", $q->toSQL());
    }

}