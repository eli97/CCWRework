<?php

    //~~~~~~~~~~~~~~~~~ DATABSE SETTINGS ~~~~~~~~~~~~~~~~~
    //
    error_reporting(E_ALL & ~E_NOTICE);
    define("DB_HOST", "localhost");
    define("DB_NAME", "rystaly5_CrystClearMainDB");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "rystaly5_cbearquiver");
    define("DB_PASSWORD", "SvenThePlant!");

    //~~~~~~~~~~~~~~~~~ GET FUNCTIONS ~~~~~~~~~~~~~~~~~
    //
    function getAllServices()
    {
        // CONNECT TO DATABASE
        try {
          $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
            DB_USER, DB_PASSWORD
          );
        } catch (Exception $ex) { exit($ex->getMessage()); }
        
        $data = [];
        $dataCtr = 0;

        $stmt = $pdo->prepare("SELECT * FROM `SERVICE`");
        $stmt->execute();
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($services as $service) {

            $result = array();

            $result += array('serviceName' => $service['serviceName']);
            $result += array('servicePrice' => $service['price']);
            $result += array('serviceDescription' => $service['description']);
            $result += array('SERVICE_ID' => $service['SERVICE_ID']);
            $result += array('serviceIsHidden' => $service['is_hidden']);

            $data['Service' . $dataCtr] = $result;
            $dataCtr++;
        }
        $data['length'] = $dataCtr;

        echo json_encode(['results' => $data]);
    }

    function getAllServicesUser()
    {
        // CONNECT TO DATABASE
        try {
          $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
            DB_USER, DB_PASSWORD
          );
        } catch (Exception $ex) { exit($ex->getMessage()); }
        
        $data = [];
        $dataCtr = 0;

        $stmt = $pdo->prepare("SELECT * FROM `SERVICE` WHERE `is_hidden` = '0'");
        $stmt->execute();
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($services as $service) {

            $result = array();

            $result += array('serviceName' => $service['serviceName']);
            $result += array('servicePrice' => $service['price']);
            $result += array('serviceDescription' => $service['description']);
            $result += array('SERVICE_ID' => $service['SERVICE_ID']);

            $data['Service' . $dataCtr] = $result;
            $dataCtr++;
        }
        $data['length'] = $dataCtr;

        echo json_encode(['results' => $data]);
    }
    
    //~~~~~~~~~~~~~~~~~ SET FUNCTIONS ~~~~~~~~~~~~~~~~~
    //
    function setServiceByID()
    {
        // CONNECT TO DATABASE
        try {
          $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
            DB_USER, DB_PASSWORD
          );
        } catch (Exception $ex) { exit($ex->getMessage()); }
        
        $stmt = $pdo->prepare("UPDATE `SERVICE` SET `price`=:new_price, `description`=:new_description, `serviceName`=:new_name WHERE `SERVICE_ID` =:ID");
        $stmt->bindParam(':new_price', sanitize($_POST['var2']), PDO::PARAM_STR);
        $stmt->bindParam(':new_description', sanitize($_POST['var3']));
        $stmt->bindParam(':new_name', sanitize($_POST['var4']));
        $stmt->bindParam(':ID', sanitize($_POST['var5']), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "OK";
        }
        else
            echo "NG";
    }

    function setServiceImageByID()
    {
      $input = $_FILES['var2'];
      $output = 'test.jpg';
      file_put_contents($output, file_get_contents($input));

      echo 'input: ' . $input;

        // CONNECT TO DATABASE
        try {
          $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
            DB_USER, DB_PASSWORD
          );
        } catch (Exception $ex) { exit($ex->getMessage()); }
        
        $stmt = $pdo->prepare("UPDATE `SERVICE` SET `image`=:new_image WHERE `SERVICE_ID` =:ID");
        $stmt->bindParam(':new_image', sanitize($_POST['var3']));
        $stmt->bindParam(':ID', sanitize($_POST['var4']), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "OK";
        }
        else
            echo "NG";
    }

    function toggleHideServiceByID()
    {
        // CONNECT TO DATABASE
        try {
          $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
            DB_USER, DB_PASSWORD
          );
        } catch (Exception $ex) { exit($ex->getMessage()); }
        
        $stmt = $pdo->prepare("UPDATE `SERVICE` SET `is_hidden`=:hide_status WHERE `SERVICE_ID`=:ID");
        $stmt->bindParam(':ID', sanitize($_POST['var2']), PDO::PARAM_STR);
        $stmt->bindParam(':hide_status', sanitize($_POST['var3']), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "OK";
        }
        else
            echo "NG";
    }

    function addNewService()
    {
      // CONNECT TO DATABASE
      try {
        $pdo = new PDO(
          "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
          DB_USER, DB_PASSWORD
        );
      } catch (Exception $ex) { exit($ex->getMessage()); }

      $stmt = $pdo->prepare("INSERT INTO `SERVICE` (`price`, `description`, `serviceName`) VALUES ('', '', '')");
      if ($stmt->execute()) {
          echo "OK";
      }
      else
          echo "NG";
    }

    // Input sanitization function
    //
    function sanitize($input) 
    {
      if(is_array($input)):
        foreach($input as $key=>$value):
          $result[$key] = sanitize($value);
        endforeach;
      else:
        $result = htmlentities($input, ENT_QUOTES, 'UTF-8');
      endif;

      return $result;
    }

    // DELETE FUNCTIONS
    //
    function deleteServiceByID()
    {
        // CONNECT TO DATABASE
        try {
          $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
            DB_USER, DB_PASSWORD
          );
        } catch (Exception $ex) { exit($ex->getMessage()); }
        
        $stmt = $pdo->prepare("DELETE FROM `SERVICE` WHERE `SERVICE_ID` =:ID");
        $stmt->bindParam(':ID', sanitize($_POST['var2']), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "DOK";
        }
        else
            echo "NG";
    }

    // Use a case switch to determine what to do with the provided input
    //
    if(isset($_POST['var1'])) 
    { 
      $queryCase = sanitize($_POST['var1']);

      switch ($queryCase) 
      {
          case "getAllServices":
            getAllServices();
            break;

          case "getAllServicesUser":
            getAllServicesUser();
            break;

          case "setServiceByID":
            setServiceByID();
            break;

          case "addNewService":
            addNewService();
            break;

          case "toggleHideServiceByID":
            toggleHideServiceByID();
            break;

          case "deleteServiceByID":
            deleteServiceByID();
            break;

          case  "setServiceImageByID":
            setServiceImageByID();
            break;

          default:
              echo "None selected.";
      }
  }

  if(isset($_POST['submit']))
  {
    if(isset($_FILES["pic"]) && $_FILES["pic"]["error"] == 0) 
    { 
      $temp_name = $_FILES['pic']['tmp_name'];
      
      $id = $_POST['serviceID'];

      $input = $temp_name;
      $output = $id . '_servicePicture.jpeg';

      file_put_contents('/home3/rystaly5/public_html/assets/img/' . $output, file_get_contents($temp_name));

      header("Location: https://crystalclearwestsac.com/admin.html");
    }
 }
    
    // CLOSE DATABASE CONNECTION
    $pdo = null;
    $stmt = null;

?>
