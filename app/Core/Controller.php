<?php
    trait Controller {
        public function view($view, $data = []){
            $header = "../app/Views/includes/header.php";
            $filename = "../app/Views/" . $view . ".view.php";
            $footer = "../app/Views/includes/footer.php";
            if (file_exists($header)) {
                require $header;
            }else {
                echo "not found";
            }
            if (file_exists($filename)){
                require $filename;
            }else {
                require "../app/Views/404.view.php";
            }
            if (file_exists($footer)) {
                require $footer;
            }else {
                echo "not found";
            }
        }

        public function view_with_out_header_footer($view, $data = []): void
        {
            $filename = "../app/Views/" . $view . ".view.php";
            if (file_exists($filename)){
                require $filename;
            }else {
                require "../app/Views/404.view.php";
            }
        }
    }