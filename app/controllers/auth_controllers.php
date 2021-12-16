<?php
class auth_controllers{
    public function index(){
        global $db;
        $members = $db->read("select * from customers");
        $members["status"] = 200;
        other_helpers::response($members);
    }

    public function delete($params){
        $id = $params["customer_id"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNull($id)){
            global $db;
            $delete = $db->delete("customers", $id);
            if ($delete !== false){
                $response["status"] = 200;
                $response["message"] = "the deletion was successful";
            }else{
                $response["status"] = 400;
                $response["message"] = "system problem please try again later";
            }
        }
        other_helpers::response($response);
    }

    public function create($params){
        global $db;
        $name = $params["name"] ?? null;
        $lastname = $params["lastname"] ?? null;
        $email = $params["email"] ?? null;
        $password = $params["password"] ?? null;
        $phone = $params["phone"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNull($name, $lastname, $email, $password, $phone)){
            $member = $db->read("select * from customers where email = ?", $email);
            if ($member === false){
                $customerId = $db->create(
                    "customers",
                    "name,lastname,email,password,phone",
                    $name, $lastname, $email, md5($password), $phone
                );
                if ($customerId > 0){
                    $response["customerId"] = $customerId;
                    $response["status"] = 200;
                    $response["message"] = "your registration has been successfully completed";
                }else{
                    $response["status"] = 400;
                    $response["message"] = "system problem please try again later";
                }
            }else{
                $response["status"] = 400;
                $response["message"] = "{$email} you are already a member";
            }
        }
        other_helpers::response($response);
    }
}
?>