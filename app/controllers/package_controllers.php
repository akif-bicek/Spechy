<?php
class package_controllers{
    public function index(){
        global $db;
        $members = $db->read("select * from package");
        $members["status"] = 200;
        other_helpers::response($members);
    }

    public function delete($params){
        $id = $params["package_id"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNotNull($id)){
            global $db;
            $delete = $db->delete("package", $id);
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
        $price = $params["price"] ?? null;
        $company_id = $params["company_id"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNotNull($name, $price, $company_id)){
            $package = $db->read("select * from package where name = ?", $name);
            if ($package === false){
                $packageId = $db->create(
                    "package",
                    "name,price,company_id",
                    $name, $price, $company_id
                );
                if ($packageId > 0){
                    $response["packageId"] = $packageId;
                    $response["status"] = 200;
                    $response["message"] = "package saving has been successfully completed";
                }else{
                    $response["status"] = 400;
                    $response["message"] = "system problem please try again later";
                }
            }else{
                $response["status"] = 400;
                $response["message"] = "{$name} package is already saved";
            }
        }
        other_helpers::response($response);
    }
    public function register($params){
        global $db;
        $agreement = 12;
        $customer_id = $params["customer_id"] ?? null;
        $package_id = $params["package_id"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNotNull($customer_id, $package_id)){
            $customer = $db->read("select * from customers where id = ?", $customer_id);
            $package = $db->read("select * from package where id = ?", $package_id);
            if(($customer !== false) and ($package !== false)){
                $customer_packages = $db->read(
                    "select * from customer_package where package_id = ? and customer_id = ?",
                    $package_id, $customer_id
                );
                if ($customer_packages === false){
                    $customer_package_id = $db->create(
                        "customer_package",
                        "customer_id,package_id,agreement",
                        $customer_id, $package_id, $agreement
                    );
                    if ($customer_package_id > 0){
                        for ($i = 1; $i <= $agreement; $i++){
                            $name = $customer[0]["name"] . ":" . $package[0]["name"] . " " . $i . ". payment";
                            $price = $package[0]["price"];
                            $db->create(
                                "customer_payment",
                                "customer_package_id,name,price,paided",
                                $customer_package_id,$name,$price,0
                            );
                        }
                    }else{
                        $response["status"] = 400;
                        $response["message"] = "customer or package not found!";
                    }
                    $response["customer_id"] = $customer_id;
                    $response["package_id"] = $package_id;
                    $response["customer_package_id"] = $customer_package_id;
                    $response["status"] = 200;
                    $response["message"] = "Your package has been successfully registered";
                }else{
                    $response["status"] = 400;
                    $response["message"] = "you are already registered in the package";
                }
            }else{
                $response["status"] = 400;
                $response["message"] = "customer or package not found!";
            }
        }
        other_helpers::response($response);
    }
    public function cancel($params){
        global $db;
        $customer_id = $params["customer_id"] ?? null;
        $package_id = $params["package_id"] ?? null;
        $response = array("status" => 400, "message" => "please fill in all the required fields");
        if (other_helpers::isNotNull($customer_id, $package_id)){
            $customer = $db->read("select * from customers where id = ?", $customer_id);
            $package = $db->read("select * from package where id = ?", $package_id);
            if(($customer !== false) and ($package !== false)){
                $customer_packages = $db->read(
                    "select * from customer_package where package_id = ? and customer_id = ?",
                    $package_id, $customer_id
                );
                if ($customer_packages !== false){
                    $deleteCustomerPackage = $db->delete("customer_package", $customer_packages[0]["id"]);
                    $ok = true;
                    if($deleteCustomerPackage !== false){
                        $db->delete("customer_payment", $customer_packages[0]["id"], "customer_package_id");
                    }else{
                        $ok = false;
                    }
                    if($ok){
                        $response["customer_id"] = $customer_id;
                        $response["package_id"] = $package_id;
                        $response["customer_package_id"] = $package_id;
                        $response["status"] = 200;
                        $response["message"] = "Your package has been successfully canceled";
                    }else{
                        $response["status"] = 400;
                        $response["message"] = "system problem please try again later";
                    }
                }else{
                    $response["status"] = 400;
                    $response["message"] = "customer or package not found!";
                }
            }else{
                $response["status"] = 400;
                $response["message"] = "customer or package not found!";
            }
        }
        other_helpers::response($response);
    }
    public function customerPackage($params){
        global $db;
        $customer_id = $params["customer_id"] ?? null;
        if (other_helpers::isNotNull($customer_id)){
            $packages = $db->read("select * from customer_package where customer_id = ?", $customer_id);
            if ($packages !== false){
                $packages["status"] = 200;
                other_helpers::response($packages);
            }else{
                other_helpers::response([400, "defined package not found"]);
            }
        }else{
            other_helpers::response([400, "defined package not found"]);
        }
    }
    public function companyPackage($params){
        global $db;
        $company_id = $params["company_id"] ?? null;
        if (other_helpers::isNotNull($company_id)){
            $packages = $db->read("select * from package where company_id = ?", $company_id);
            if ($packages !== false){
                $packages["status"] = 200;
                other_helpers::response($packages);
            }else{
                other_helpers::response([400, "defined package not found"]);
            }
        }else{
            other_helpers::response([400, "defined package not found"]);
        }
    }
    public function payments($params){
        global $db;
        $customer_id = $params["customer_id"] ?? null;
        $package_id = $params["package_id"] ?? null;
        if (!other_helpers::isNotNull($customer_id, $package_id)){
            if (other_helpers::isNotNull($customer_id)){
                $packages = $db->read("select * from customer_package where customer_id = ?", $customer_id);
                if ($packages !== false){
                    $allPayments = array();
                    $total = 0;
                    foreach ($packages as $package){
                        $payments = $db->read("select * from customer_payment where customer_package_id = ?", $package["id"]);
                        $allPayments[] = $payments;
                        $total += (floatval($payments[0]["price"]) * 12);
                    }
                    echo $total;
                    other_helpers::response(["status" => "200", "total_payment" => round($total), "payments" => $allPayments]);
                    die();
                }
            }
        }
        if (other_helpers::isNotNull($customer_id, $package_id)){
            $package = $db->read("select * from customer_package where customer_id = ? and package_id = ?", $customer_id, $package_id);
            if ($package !== false){
                $payments = $db->read("select * from customer_payment where customer_package_id = ?", $package[0]["id"]);
                $allPayments = array();
                $total = 0;
                foreach ($payments as $payment){
                    $allPayments[] = array($payment);
                    $total += (double)$payment["price"];
                }
                $payments["status"] = 200;
                other_helpers::response(["status" => "200", "total_payment" => round($total), "payments" => $allPayments]);
                die();
            }
        }
        other_helpers::response([400, "payment is not found"]);
    }
}
?>