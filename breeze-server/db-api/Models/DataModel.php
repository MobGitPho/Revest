<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class DataModel extends \API\Database\Classes\DbManager
{
    private $tbTable;
    private $mbTable;

    public function __construct(){

        parent::__construct();

        $this->tbTable = Functions::resolveTableName('tables_backup');
        $this->mbTable = Functions::resolveTableName('medias_backup');

    }

    public function fetchTablesBackups()
    {
        return $this->getItems($this->tbTable);
    }

    public function fetchMediasBackups()
    {
        return $this->getItems($this->mbTable);
    }

    public function insertNewTablesBackup($newTablesBackup)
    {
        return $this->insertItem($newTablesBackup, $this->tbTable);
    }

    public function insertNewMediasBackup($newMediasBackup)
    {
        return $this->insertItem($newMediasBackup, $this->mbTable);;
    }

    public function deleteTablesBackup($id)
    {
        return $this->deleteItem($id, $this->tbTable);
    }

    public function deleteMediasBackup($id)
    {
        return $this->deleteItem($id, $this->mbTable);
    }

    public function backupDatabaseTables($filepath, $tables = '*', $excluded_tables = array(), $table_separator = ';')
    {
        if ($tables == '*') {
            $tables = array();

            $result = $this->database->query("SHOW TABLES");

            while ($row = $result->fetch()) {
                if (!in_array($row[0], $excluded_tables)) $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode($table_separator, $tables);
        }

        $return = '';

        foreach ($tables as $table) {
            $result = $this->database->query("SELECT * FROM $table");

            $numColumns = $result->columnCount();

            /* $return .= "DROP TABLE $table;"; */
            $result2 = $this->database->query("SHOW CREATE TABLE $table");
            $row2 = $result2->fetch();

            $return .= "\n\n" . $row2[1] . ";\n\n";

            for ($i = 0; $i < $numColumns; $i++) {
                while ($row = $result->fetch()) {
                    $return .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $numColumns; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = $row[$j];
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($numColumns - 1)) {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }

            $return .= "\n\n\n";
        }

        $handle = fopen($filepath, 'w+');
        fwrite($handle, $return);
        fclose($handle);

        return true;
    }
}
