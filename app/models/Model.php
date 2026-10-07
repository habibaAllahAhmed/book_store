<?php
require_once __DIR__ . "/../../core/database.php";

class Model
{
    protected PDO $DB;

    public function __construct()
    {
        $this->DB = database::getConnection();
    }

    public static function prepareWhereQuery(array $wheres = [])
    {
        $wheresQuery = "";

        if (!empty($wheres)) {
            $wheresQuery = "WHERE ";
            $counter = 1;

            foreach ($wheres as $where) {

                if ($counter > 1) {
                    $wheresQuery .= isset($where[3]) ? $where[3] . " " : "AND ";
                }

                $wheresQuery .= " {$where[0]} {$where[1]} '{$where[2]}'";

                $counter++;
            }
        }

        return $wheresQuery;
    }
}
