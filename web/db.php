<?php
/*
Examples of using this class:

1. Getting rows in a loop
$stmt = Database::run("SELECT * FROM table");
while ($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    echo $row['name'],",";
    echo $row->name,",";
    echo $row[1], PHP_EOL;
}

2. Getting one row
$stmt = Database::run("SELECT * FROM table WHERE id=?", [$id])->fetch();
var_export($stmt);

3. Getting single field value
$stmt = Database::run("SELECT field FROM table WHERE id=?", [$id])->fetchColumn();
var_dump($stmt);

4. Getting array of rows
$stmt = Database::run("SELECT field1, field2 FROM table")->fetchAll(PDO::FETCH_KEY_PAIR);
var_export($stmt);

5. Update
$stmt = Database::run("UPDATE table SET field1=? WHERE field2=?", [$field1, $field2]);
var_dump($stmt->rowCount());
*/


class Database
{
	private $dbhost = DB_HOST;
	private $dbname = DB_NAME;
	private $dbuser = DB_USER;
	private $dbpass = DB_PASS;
	private $dbchar = DB_CHAR;

    protected static $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    public static function instance()
    {
        if (self::$instance === null)
        {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
            );
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}


?>
