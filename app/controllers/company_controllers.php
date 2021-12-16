<?php
class company_controllers{
    public function index(){
        global $db;
        $members = $db->read("select * from company");
        $members["status"] = 200;
        other_helpers::response($members);
    }

    public function delete($params){
        $id = $params["company_id"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNull($id)){
            global $db;
            $delete = $db->delete("company", $id);
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
        $email = $params["email"] ?? null;
        $phone = $params["phone"] ?? null;
        $tax_circle = $params["tax_circle"] ?? null;
        $tax_no = $params["tax_no"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNull($name, $tax_circle, $email, $tax_no, $phone)){
            $company = $db->read("select * from company where email = ?", $email);
            if ($company === false){
                $companyId = $db->create(
                    "company",
                    "name,email,phone,tax_no,tax_circle",
                    $name, $email, $phone, $tax_no, $tax_circle
                );
                if ($companyId > 0){
                    $response["companyId"] = $companyId;
                    $response["status"] = 200;
                    $response["message"] = "your company registration has been successfully completed";
                }else{
                    $response["status"] = 400;
                    $response["message"] = "system problem please try again later";
                }
            }else{
                $response["status"] = 400;
                $response["message"] = "{$email} your company already registered";
            }
        }
        other_helpers::response($response);
    }
}
?>