<?php
    class Task {
        use Model;
        protected $db_table = 'task';
        protected $order_col = "id";
        protected $order_type = "desc";
        protected $limit = 20;
        protected $offset = 0;
        protected $update_id = 'id';
        protected $allowedColumns = [
            'taskName ',
            'taskDescription',
            'taskSetupDate',
            'taskScheduleDate',
            'taskStartTime',
            'TaskDuration',
            'TaskEndTime'            
        ];

        public function createDatabaseTaskTable() 
        {
            try {
                $sql = "CREATE TABLE IF NOT EXISTS task (
                    `Id` int NOT NULL AUTO_INCREMENT,
                    `taskName` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
                    `taskDescription` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
                    `taskSetupDate` Date NOT NULL,
                    `taskScheduleDate`Date COLLATE utf8mb4_general_ci NOT NULL,
                    `taskStartTime` Time NOT NULL,
                    `TaskDuration` int NOT NULL,
                    `TaskEndTime` Time NOT NULL,
                    PRIMARY KEY (`Id`)
                )";
                $this->query($sql);
            }catch (Exception $e) {
                echo ("Error: " . $e->getMessage());
                die();
            }
        }
    }