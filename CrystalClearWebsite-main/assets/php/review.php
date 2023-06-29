<?php 
define("DB_HOST", "localhost");
define("DB_NAME", "rystaly5_CrystClearMainDB");
define("DB_CHARSET", "utf8");
define("DB_USER", "rystaly5_cbearquiver");
define("DB_PASSWORD", "SvenThePlant!");
   session_start();
   try {
        $conn = $conn = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $json_review = [];
    //write review
    
    if(isset($_POST['writtenReview'])){
        if(isset($_POST['rating']) && isset($_POST['message']) != null && isset($_POST['clientReview'])){
            $value = $_POST['rating'];
            $review = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
            

            $date = date("Y-m-d");
            echo "Today is";
            echo $date; 
            echo "<br>";

            echo "Stars:";
            echo $value; 
            echo "<br>";

            echo "review:";
            echo $review; 
            echo "<br>";
            
            $person = $_POST['clientReview'];
            $name = substr($person,0 , strpos($person, ":"));
            $cid = substr($person, strpos($person, ":") + 1);
            echo "name:";
            echo $name; 
            echo "<br>";

            echo "cid:";
            echo $cid; 
            echo "<br>";
            $sql = "INSERT INTO REVIEW (cid, cname, postDate, stars, message, approval)
                    VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$cid, $name, $date, $value, $review, 0]);
            header('Location: /CrystalClearWebsite/review.html');
        
        }
    }
    //Delete Review
    if(isset($_GET['delete'])){
        $value = $_GET['delete'];
        $cid = substr($value,0 , strpos($value, ":"));
        $post = substr($value, strpos($value, ":") + 1);
        echo $cid;
        echo "<br>";
        echo $post;
        echo "<br>";
        
        $sql = "DELETE FROM review WHERE cid=$cid AND approval=0 AND postID=$post";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header('Location: /CrystalClearWebsite/reviewPost.html'); 
    }
    //update the changes 
    if(isset($_POST['approvalChanges'])){
        if(isset($_POST['update'])){
            //set all approval to 0s
            $sql = "UPDATE REVIEW SET approval=0";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
         
            foreach($_POST['update'] as $value){
                $cid = substr($value,0 , strpos($value, ":"));
                $post = substr($value, strpos($value, ":") + 1);
                echo $cid;
                echo "<br>";
                echo $post;
                echo "<br>";
            
                $sql = "UPDATE review SET approval=1 WHERE cid=$cid AND postID=$post";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
            }
    
        header('Location: /CrystalClearWebsite/reviewPost.html'); 
        }
        
    }
    $sql = "SELECT * FROM REVIEW ORDER BY postDate";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    //$result = $stmt->fetchAll();
    //var_dump($result);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data = array( );
        $data['cid']     = $row['cid'];
        $data['postID']  = $row['postID'];
        $data['cname']   = $row['cname'];
        $data['postDate']= $row['postDate'];
        $data['stars']   = $row['stars'];
        $data['message'] = $row['message'];
        $data['approval']= $row['approval'];
        
        $encode = json_encode($data);
        array_push($json_review,$encode);

    }

    echo (json_encode($json_review, JSON_PRETTY_PRINT));
    $conn = null;

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
?>