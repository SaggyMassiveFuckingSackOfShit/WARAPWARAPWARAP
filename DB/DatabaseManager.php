<?php
class DatabaseManager {
    private $conn;
    private $tableName;
    private $columns = [
        'SUBMISSION DATE',
        'PLAN',
        'UPLOADED FILE',
        'PRIME PLAN',
        'CARD TYPE',
        'AVAILMENT DATE', 
        'SURNAME', 
        'EFFECTIVE DATE', 
        'CARDNUMBER', 
        'SO',
        'BUH', 
        'BH', 
        'SD', 
        'REFERER OR HANDLING AGENT', 
        'DATA PRIVACY CLAUSE',
        'ASSIGNED BPIA EMPLOYEE', 
        'COVERAGE CLAUSE', 
        'MOBILE NUMBER', 
        'EMAIL ADDRESS',
        'BENEFICIARY FULL NAME', 
        'BENEFICIARY RELATIONSHIP', 
        'BENEFICIARY BIRTHDATE',
        'COMPLETE ADDRESS', 
        'GIVE NAME', 
        'MIDDLE NAME', 
        'BITHDATE', 
        'AGE',
        'STUDENT PLAN', 
        'MODE OF PAYMENT', 
        'SUBMISSION ID', 
        'SUBMISSION IP',
        'LAST UPDATE DATE'
    ];

    public function __construct($host, $username, $password, $database, $tableName) {
        try {
            $this->conn = new PDO("mysql:host=$host;port=4306;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->tableName = $tableName;
        } catch(PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function insertExcelData($data) {
        $timestamp = date('Y-m-d H:i:s');

        try {
            file_put_contents("debug/debug_db.log", "[{$timestamp}] Entry inserted with card number of " . $data[0][8] . "\n", FILE_APPEND);
            $placeholders = str_repeat('?,', count($this->columns) - 1) . '?';
            $sql = "INSERT INTO {$this->tableName} (" . implode(',', array_map(fn($col) => "`$col`", $this->columns)) . ") VALUES ($placeholders)";
            $stmt = $this->conn->prepare($sql);
            foreach ($data as $row) {
                $stmt->execute(array_pad($row, 32, null));
            }
            return true;
        } catch(PDOException $e) {
            throw new Exception("Error inserting data: " . $e->getMessage());
        }
    }

    public function findEmailByCardNumber($cardNumber) {
        $stmt = $this->conn->prepare("SELECT `EMAIL ADDRESS` FROM {$this->tableName} WHERE CARDNUMBER = ?");
        $stmt->execute([$cardNumber]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $timestamp = date('Y-m-d H:i:s');


        file_put_contents("debug/debug_db.log","[{$timestamp}]  Fetched email: {$cardNumber} : " . $result['EMAIL ADDRESS'] . "\n", FILE_APPEND);
        return $result['EMAIL ADDRESS'];
    }

    public function cardNumberExists($cardNumber) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM {$this->tableName} WHERE CARDNUMBER = ?");
        $stmt->execute([$cardNumber]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0; 
        file_put_contents("debug/debug_db.log","cardNumberExists: {$cardNumber} : " . $result == 1 . "\n", FILE_APPEND);
        return $result;
    }
    public function close() {
        $this->conn = null;
    }
} 