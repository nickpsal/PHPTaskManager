<?php
    class Home {
        use Controller;
        public function index($data = [])
        {
            $tasks = new Task();
            $data['title'] = 'All Tasks';
            date_default_timezone_set('Europe/Athens');
            $dateFormatter = new IntlDateFormatter('el_GR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
            //get day of the week
            $dateFormatter->setPattern('EEEE');
            $data['currentday'] = $dateFormatter->format(date_create());
            //get dd//MM/YYYY
            $dateFormatter->setPattern('dd/MM/yyyy');
            $data['currentDate'] = explode('/',$dateFormatter->format(date_create()));
            $data['currentMonthName'] = getMonthName($data['currentDate'][1]);
            $tasks->createDatabaseTaskTable();
            $data['tasks'] = $tasks->find_all_data_from_db();
            $this->view('home', $data); 
        }

        public function show($data = []) {
            $tasks = new Task();
            $data['title'] = 'All Tasks';
            date_default_timezone_set('Europe/Athens');
            $dateFormatter = new IntlDateFormatter('el_GR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
            //get day of the week
            $dateFormatter->setPattern('EEEE');
            $data['currentday'] = $dateFormatter->format(date_create());
            //get dd//MM/YYYY
            $dateFormatter->setPattern('dd/MM/yyyy');
            $data['currentDate'] = explode('/',$dateFormatter->format(date_create()));
            $data['currentDate'][1] = $_GET['month'];
            $data['currentMonthName'] = getMonthName($data['currentDate'][1]);
            $tasks->createDatabaseTaskTable();
            $data['tasks'] = $tasks->find_all_data_from_db();
            $this->view('home', $data); 
        }

        public function add($data = [])
        {
            $request = new Request();
            $tasks = new Task();
            if ($request->is_get()) {
                $data['title'] = 'All Tasks';
                $this->view('addupdatetask', $data); 
            }else {

            }
        }

        public function update($data = [])
        {
            $request = new Request();
            $tasks = new Task();
            if ($request->is_get()) {
                $data['title'] = 'Update Task';
                $query['id'] = $_GET['id'];
                $data['data'] = $tasks->get_first_query_db($query);
                if (!empty($data['data'])) {
                    $this->view('addupdatetask', $data); 
                }else {
                    redirect('home');
                }
            }else {

            }
        }

        public function delete($data = []) {
            $request = new Request();
            $tasks = new Task();
            if ($request->is_get()) {
                $data['title'] = 'Update Task';
                $query['id'] = $_GET['id'];
                $data['data'] = $tasks->get_first_query_db($query);
                if (!empty($data['data'])) {
                    $tasks->delete_data_from_db($query['id']);
                    redirect('home');
                }else {
                    redirect('home');
                }
            }
        }
    }