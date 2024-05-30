<?php
require_once 'config/connection.php';

class Offset1 extends Connection
{
    public function search_employee_offset($query){
        try{
            $conn = $this->open();
            $sql = "SELECT 
                        e.employee_id,
                        CONCAT(e.first_name, ' ', e.middle_name, ' ', e.last_name) AS full_name,
                        et.employee_type,
                        ep.position,
                        ep.status AS position_status,
                        of.total_offset
                    FROM 
                        tbl_employee e
                    JOIN 
                        tbl_employee_details ed ON e.employee_id = ed.employee_id
                    JOIN 
                        tbl_employee_type et ON ed.employee_type_id = et.employee_type_id
                    JOIN 
                        tbl_employee_position ep ON ed.position_id = ep.position_id
                    LEFT JOIN 
                        tbl_offset of ON e.employee_id = of.employee_id
                    WHERE 
                        (e.first_name LIKE :query OR e.middle_name LIKE :query OR e.last_name LIKE :query)
                        AND ed.employee_type_id = 2 AND ed.part_time = 0";

            $stmt = $conn->prepare($sql);
            $search_query = "%$query%";
            $stmt->bindParam(':query', $search_query, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch(PDOException $e){
            die("Error: ". $e->getMessage());
        }   
    }

    public function search_employee_leave_credits($query1) {
        try {
            $conn = $this->open();
            $sql = "SELECT 
                        e.employee_id,
                        CONCAT(e.first_name, ' ', e.middle_name, ' ', e.last_name) AS full_name,
                        et.employee_type,
                        ep.position,
                        ep.status AS position_status,
                        COALESCE(lc_content.vacation_leave, 0) AS vacation_leave,
                        COALESCE(lc_content.sick_leave, 0) AS sick_leave
                    FROM 
                        tbl_employee e
                    JOIN 
                        tbl_employee_details ed ON e.employee_id = ed.employee_id
                    JOIN 
                        tbl_employee_type et ON ed.employee_type_id = et.employee_type_id
                    JOIN 
                        tbl_employee_position ep ON ed.position_id = ep.position_id 
                    LEFT JOIN 
                        tbl_leave_credits lc ON e.employee_id = lc.employee_id
                    LEFT JOIN
                        tbl_leave_credits_content lc_content ON lc.leave_credits_id = lc_content.leave_credits_id
                    WHERE 
                        (e.first_name LIKE :query OR e.middle_name LIKE :query OR e.last_name LIKE :query)
                        AND et.employee_type_id IN (1, 2)
                        AND ed.part_time = 0";
            
            $stmt = $conn->prepare($sql);
            $search_query = "%{$query1}%";
            $stmt->bindParam(':query', $search_query, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    
        } catch(PDOException $e) {
            die("Error: ". $e->getMessage());
        }   
    }

    public function search_employee($query2) {
        try {
            $conn = $this->open();
            $sql = "SELECT 
                        e.employee_id,
                        e.first_name,
                        e.middle_name,
                        e.last_name,
                        CONCAT(e.first_name, ' ', e.middle_name, ' ', e.last_name) AS full_name
                    FROM 
                        tbl_employee e
                    WHERE 
                        e.first_name LIKE :query OR 
                        e.middle_name LIKE :query OR 
                        e.last_name LIKE :query";
            
            $stmt = $conn->prepare($sql);
            $search_query = "%{$query2}%";
            $stmt->bindParam(':query', $search_query, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    
        } catch(PDOException $e) {
            die("Error: ". $e->getMessage());
        }   
    }
    
    function search_employee_leave($query3) {
        try {
            $conn = $this->open();
            $sql = "SELECT * FROM display_leave_employee_content WHERE full_name LIKE :query ORDER BY full_name";
            
            $stmt = $conn->prepare($sql);
            $search_query = "%{$query3}%";
            $stmt->bindParam(':query', $search_query, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    
        } catch(PDOException $e) {
            die("Error: ". $e->getMessage());
        }   
    }
    
}

if(isset($_POST['query'])){
    $search = new Offset1();
    $result = $search->search_employee_offset($_POST['query']);
    if($result){
        foreach ($result as $row) {
            echo "<div class='search-item' data-id='".$row['employee_id']."' data-total-offset='".$row['total_offset']."'>".$row['full_name']."</div>";
        }
    } else {
        echo "<div class='search-item'>No results found</div>";
    }
}

if(isset($_POST['query1'])){
    $search = new Offset1();
    $result = $search->search_employee_leave_credits($_POST['query1']);
    if($result){
        foreach ($result as $row) {
            echo "<div class='search-item' data-id='".$row['employee_id']."' data-total-vacation_leave='".$row['vacation_leave']."' data-total-sick_leave='".$row['sick_leave']."'>".$row['full_name']."</div>";
        }
    } else {
        echo "<div class='search-item'>No results found</div>";
    }
}

if (isset($_POST['query2'])) {
    $search = new Offset1();
    $result = $search->search_employee($_POST['query2']);
    if ($result) {
        foreach ($result as $row) {
            echo "<div class='search-item' data-id='".$row['employee_id']."'>".$row['full_name']."</div>";
        }
    } else {
        echo "<div class='search-item'>No results found</div>";
    }
}

if (isset($_POST['query3'])) {
    $search = new Offset1();
    $result = $search->search_employee_leave($_POST['query3']);
    if ($result) {
        foreach ($result as $row) {
            echo "<div class='search-item list-group-item' data-id='".$row['details_id']."' data-position='".$row['position']."' data-department_id='".$row['department_id']."'>".$row['full_name']."</div>";
        }
    } else {
        echo "<div class='search-item list-group-item'>No results found</div>";
    }
}


?>