<?php    
    trait Database {
        private $pdo;
        private function connect() {
            if (!$this->pdo) {
                try {
                    $string = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
                    $this->pdo = new PDO($string, DB_USER, DB_PASS);
                    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    throw new Exception("Database connection failed: " . $e->getMessage());
                }
            }
            return $this->pdo;
        }

        public function query($query, $query_data = []) {
            $start_time = microtime(true);
            $con = $this->connect();
            try {
                $stm = $con->prepare($query);
                $check = $stm->execute($query_data);
                if (!$check) {
                    throw new Exception("Query execution failed: " . implode(" ", $stm->errorInfo()));
                }
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $e) {
                throw new Exception("Query execution failed: " . $e->getMessage());
            } finally {
                $end_time = microtime(true);
                $execution_time = ($end_time - $start_time) * 1000;
                $log_message = $query . " [" . number_format($execution_time, 2) . " ms]";
                error_log($log_message);
            }
        }
    }
