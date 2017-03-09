<?php

    class EmployeeController extends Controller{

        public function actionIndex(){

            $this->view('user/index');
        }

        public function actionCreate(){

            $data = new Employee();

            $data->ident = Employee::ids();
            $data->name = trim($_POST['name']);
            $data->designation = trim($_POST['designation']);
            $data->gender = trim($_POST['gender']);

            $data->insert();

            echo '<span class="has-success">Added new employee</span>';
            return true;
        }

        public function actionUpdate(){

            $data = new Employee();

            $data->ident = trim($_POST['ident']);
            $data->name = trim($_POST['name']);
            $data->designation = trim($_POST['designation']);
            $data->gender = trim($_POST['gender']);

            $data->update();

            echo '<span class="has-success">Employee\'s data updated</span>';
            return true;
        }

        public function actionSearch()
        {
            $result = $_GET['result'];
            $fields = Employee::$fields;

            $all = Employee::all();

            $newArray = [];
            foreach($all as $ks => $vs) {
                foreach($fields as $field) {
                    if ($vs->$field == $result) {
                        $newArray[] = $vs;
                        continue;
                    }
                }
            }
            echo json_encode($newArray);
            return true;
        }

        public function actionDelete()
        {
            $del = explode(',', rtrim($_POST['result'], ','));

            foreach($del as $d){
            $data = Employee::find($d);
            if (!$data) {
                continue;
            }
                $dat = new Employee();
                $dat->ident = $d;
                
                $dat->delete();
            }
            echo '<span class="has-error">Employee removed from the data</span>';
            return true;
        }
}