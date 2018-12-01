<?
include("Conn.php");

class BaseModel {
    public $db;
    protected $result;       // Query result
    protected $queryErrCode; // Flag for query reuest is success or not
    protected $queryErrMsg;  // Error messsage for query reuest

    public function __construct() {
        $this->db = new Conn();
    }

    function __destruct() {
        // print "Destroying " . __CLASS__ . "\n";
    }

    // Execute database query.
    public function query($query)
    {
        try {
            $this->result = mysqli_query($this->db->conn, $query);
            if (! $this->result) {
                $this->queryErrCode = 'ERR_FAIL';
                $this->queryErrMsg = '';
            } else {
                $this->queryErrCode = 'ERR_SUCCESS';
                $this->queryErrMsg = '';
            }
        } catch (Exception $e) {
            $this->queryErrCode = "ERR_QUERY_SQL_DB_FAIL";
            $this->queryErrMsg = $e->getMessage();
        }
        return $this->queryErrCode;
    }

    public function getResult()
    {
        return $this->result;
    }

    // Determine total rows affected by query
    public function affectedRows()
    {
        return mysqli_affected_rows($this->linkid);
    }

    // Determine total rows returned by query
    public function numRows()
    {
        return mysqli_num_rows($this->result);
    }

    // Return query result row as an object.
    public function fetchObject()
    {
        return mysqli_fetch_object($this->result);
    }

    // Return query result row as an indexed array.
    public function fetchRow()
    {
        return mysqli_fetch_row($this->result);
    }

    // Return query result row as an associated array.
    public function fetchArray()
    {
        return mysqli_fetch_assoc($this->result);
    }

    // Return query result row as an indexed array.
    public function queryRow($query)
    {
        $this->query($query);
        $row = $this->fetchRow();
        $this->freeResult();
        return $row;
    }

    // Return query result row as an associated array.
    public function queryArray($query)
    {
        $this->query($query);
        $row = $this->fetchArray();
        $this->freeResult();
        return $row;
    }

    // Return query result row as an associated array.
    public function queryArrays($query)
    {
        $this->query($query);
        $rows = array();
        for ($i=0; $i<$this->numRows(); $i++) {
            $rows[] = $this->fetchArray();
        }
        $this->freeResult();
        return $rows;
    }

    public function queryReturningId()
    {
        return mysqli_insert_id($this->linkid);
    }

    // Return total number of queries executed during
    // lifetime of this object. Not required, but
    // interesting nonetheless.
    public function numQueries()
    {
        return $this->querycount;
    }

    // Handling Transaction Processing
    public function begintransaction()
    {
        $this->query('START TRANSACTION');
    }

    public function commit()
    {
        $this->query('COMMIT');
    }

    public function rollback()
    {
        $this->query('ROLLBACK');
    }

    public function setsavepoint($savepointname)
    {
        $this->query("SAVEPOINT $savepointname");
    }

    public function rollbacktosavepoint($savepointname)
    {
        $this->query("ROLLBACK TO SAVEPOINT $savepointname");
    }

    public function setTransactionParamsSerialisable()
    {
        $this->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
    }

    public function setTransactionParamsReadCommited()
    {
        $this->query("SET TRANSACTION ISOLATION LEVEL READ COMMITTED");
    }

    public function escapeString($s)
    {
        return mysqli_real_escape_string($this->linkid, $s);
    }

    public function getLastOid()
    {
        return mysqli_last_oid($this->result);
    }

    public function getLastId()
    {
        return mysqli_insert_id($this->linkid);
    }

    public function freeResult()
    {
        return mysqli_free_result($this->result);
    }

    public function querySelect($tbl, $rec, $keys, $fields="*", $orderby="")
    {
        $tbl = $this->ascii_only($tbl);
        $cols = [];
        foreach ($keys as $k) {
            $cols[] = '`'.$this->ascii_only($k).'`='."'".$this->escapeString($rec[$k])."'";
        }
        $cmd = "SELECT $fields FROM `".$tbl."`";
        if ($cols) {
            $cmd .= " WHERE ".implode(" AND ", $cols);
        }
        if ($orderby) {
            $cmd .= $orderby;
        }
        return $cmd;
    }

    public function queryInsert($tbl, $rec)
    {
        $tbl = $this->ascii_only($tbl);
        foreach ($rec as $k => $v) {
            $cols[] = '`'.$this->ascii_only($k).'`';
            if (strval($v) == "now()") {
                $vals[] = "now()";
            } else {
                $vals[] = "'".$v."'";//"'".$this->escapeString($v)."'";
            }
        }
        return "INSERT INTO `$tbl` (".implode(",", $cols).") VALUES (".implode(",", $vals).")";
    }

    public function queryInserts($tbl, $recs)
    {
        $tbl = $this->ascii_only($tbl);
        foreach ($recs[0] as $k => $v) {
            $cols[] = '`'.$this->ascii_only($k).'`';
        }
        $objs = array();
        foreach ($recs as $rec) {
            $vals = [];
            foreach ($rec as $k => $v) {
                if (strval($v) == "now()") {
                    $vals[] = "now()";
                } else {
                    $vals[] = "'".$this->escapeString($v)."'";
                }
            }
            $objs[] = "(".implode(",", $vals).")";
        }
        return "INSERT INTO `$tbl` (".implode(",", $cols).") VALUES ".implode(",", $objs);
    }

    public function queryUpdate($tbl, $rec, $keys)
    {
        $tbl = $this->ascii_only($tbl);
        foreach ($rec as $k => $v) {
            if (in_array($k, $keys)) {
                continue;
            }
            if (strval($v) == "now()") {
                $cols[] = '`'.$this->ascii_only($k).'`='."now()";
            } else {
                $cols[] = '`'.$this->ascii_only($k).'`='."'".$this->escapeString($v)."'";
            }
        }
        foreach ($keys as $k) {
            $vals[] = '`'.$this->ascii_only($k).'`='."'".$this->escapeString($rec[$k])."'";
        }
        return "UPDATE `$tbl` SET ".implode(",", $cols)." WHERE ".implode(" AND ", $vals);
    }

    public function queryDelete($tbl, $rec, $keys)
    {
        $tbl = $this->ascii_only($tbl);
        foreach ($keys as $k) {
            $cols[] = '`'.$this->ascii_only($k).'`='."'".$this->escapeString($rec[$k])."'";
        }
        $cmd = "DELETE FROM `$tbl`";
        if ($cols) {
            $cmd .= " WHERE ".implode(" AND ", $cols);
        }
        return $cmd;
    }

    public function ascii_only($s)
    {
        return preg_replace("#[^0-9a-zA-Z-_]#", "", $s);
    }
}
