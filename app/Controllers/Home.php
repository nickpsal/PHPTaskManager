<?php
    class Home {
        use Controller;
        public function index($data = [])
        {
            $tasks = new Task();
            $tasks->createDatabaseTaskTable();
            $data['title'] = 'Task Manager V1.0';
            date_default_timezone_set('Europe/Athens');
            $dateFormatter = new IntlDateFormatter('el_GR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
            //get day of the week
            $dateFormatter->setPattern('EEEE');
            $data['currentday'] = $dateFormatter->format(date_create());
            //get dd//MM/YYYY
            $dateFormatter->setPattern('dd/MM/yyyy');
            $data['currentDate'] = explode('/',$dateFormatter->format(date_create()));
            if (isset($_GET['month'])) {
                $data['currentDate'][0] = 1;
                $data['currentDate'][1] = $_GET['month'];
            }
            $data['prev'] = $data['currentDate'][1] - 1;
            $data['next'] = $data['currentDate'][1] + 1;
            $data['currentMonthName'] = getMonthName($data['currentDate'][1]);
            $data['tasks'] = $tasks->find_all_data_from_db();
            $this->view('home', $data);
        }

        public function add($data = [])
        {
            $request = new Request();
            $tasks = new Task();
            if ($request->is_get()) {
                //get YYYY-MM-dd
                $dateFormatter = new IntlDateFormatter('el_GR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                date_default_timezone_set('Europe/Athens');
                $dateFormatter->setPattern('yyyy-MM-dd');
                $data['currentDate'] = $dateFormatter->format(date_create());
                $data['title'] = 'Task Manager V1.0';
                $this->view('addupdatetask', $data); 
            }else {
                $data['taskName'] = $_POST['taskName'];
                $data['taskDescription'] = $_POST['taskDescription'];
                $data['taskSetupDate'] = $_POST['taskSetupDate'];
                $data['taskScheduleDate'] = $_POST['taskScheduleDate'];
                $data['taskStartTime'] = $_POST['taskStartTime'];
                $data['TaskDuration'] = $_POST['TaskDuration'];
                // Assuming TaskStartTime format is HH:MM and TaskDuration is in minutes
                $startTime = $_POST['taskStartTime']; // HH:MM format
                $duration = $_POST['TaskDuration']; // Duration in minutes
                // Explode the start time to get hours and minutes separately
                list($startHour, $startMinute) = explode(':', $startTime);
                // Convert start time to minutes
                $totalStartMinutes = ($startHour * 60) + $startMinute;
                // Add duration to start time in minutes
                $totalEndMinutes = $totalStartMinutes + $duration;
                // Calculate the end time in HH:MM format
                $endHour = floor($totalEndMinutes / 60);
                $endMinute = $totalEndMinutes % 60;
                // Format end time to HH:MM format
                $endTime = sprintf('%02d:%02d', $endHour, $endMinute);
                // Assign the calculated end time to TaskEndTime
                $data['TaskEndTime'] = $endTime;
                $tasks->insert_data_to_db($data);
                message("Task added to Schedule Succesfully");
                redirect("home");
            }
        }

        public function update($data = [])
        {
            $request = new Request();
            $tasks = new Task();
            $id = $_GET['id'];
            if ($request->is_get()) {
                $data['title'] = 'Task Manager V1.0';
                $query['id'] = $id;
                $data['data'] = $tasks->get_first_query_db($query);
                if (!empty($data['data'])) {
                    $this->view('addupdatetask', $data); 
                }else {
                    redirect('home');
                }
            }else {
                $data['taskDescription'] = $_POST['taskDescription'];
                $data['taskSetupDate'] = $_POST['taskSetupDate'];
                $data['taskScheduleDate'] = $_POST['taskScheduleDate'];
                $data['taskStartTime'] = $_POST['taskStartTime'];
                $data['TaskDuration'] = $_POST['TaskDuration'];
                // Assuming TaskStartTime format is HH:MM and TaskDuration is in minutes
                $startTime = $_POST['taskStartTime']; // HH:MM format
                $duration = $_POST['TaskDuration']; // Duration in minutes
                // Explode the start time to get hours and minutes separately
                list($startHour, $startMinute) = explode(':', $startTime);
                // Convert start time to minutes
                $totalStartMinutes = ($startHour * 60) + $startMinute;
                // Add duration to start time in minutes
                $totalEndMinutes = $totalStartMinutes + $duration;
                // Calculate the end time in HH:MM format
                $endHour = floor($totalEndMinutes / 60);
                $endMinute = $totalEndMinutes % 60;
                // Format end time to HH:MM format
                $endTime = sprintf('%02d:%02d', $endHour, $endMinute);
                // Assign the calculated end time to TaskEndTime
                $data['TaskEndTime'] = $endTime;
                $tasks->update_data_to_db($id, $data);
                message("Task updated to Schedule Succesfully");
                redirect("home");
            }
        }

        public function delete($data = []) {
            $request = new Request();
            $tasks = new Task();
            if ($request->is_get()) {
                $data['title'] = 'Task Manager V1.0';
                $query['id'] = $_GET['id'];
                $data['data'] = $tasks->get_first_query_db($query);
                if (!empty($data['data'])) {
                    $tasks->delete_data_from_db($query['id']);
                    redirect('home');
                }else {
                    message("Task deleted from Schedule Succesfully");
                    redirect('home');
                }
            }
        }
    }