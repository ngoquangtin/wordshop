<?php
    function view_counter($pg_id) {
        $ip = $_SERVER['REMOTE_ADDR'];
        global $dbc;

        // Truy van CSDL de xem page view
        $q = "SELECT num_views, user_ip FROM page_views WHERE page_id = $pg_id";
        $r = confirm_query($dbc, $q);

        if(mysqli_num_rows($r) > 0) {
            
            // Neu ket qua tra ve, co nghia la da ton tai trong table, Update page view
            list($num_views, $db_ip) = mysqli_fetch_array($r, MYSQLI_NUM);
            
            // So sanh IP trong CSDL va IP cua nguoi dung, neu khac nhau thi se update CSDL
            if($db_ip !== $ip) {
				$q = "UPDATE page_views SET num_views = (num_views + 1) WHERE page_id = {$pg_id} LIMIT 1";
				$r = confirm_query($dbc, $q);
			}

        } else {
            // Neu ko co ket qua tra ve, thi se insert vao table.
            $q = "INSERT INTO page_views (page_id, num_views, user_ip) VALUES ({$pg_id}, 1, '{$ip}')";
            $r = confirm_query($dbc, $q);
            $num_views = 1;
        }
        return $num_views;
    }// ENd view_counter