<?php 
                if(isset($connection)){
                $anon_id = $_SESSION['anon_id'];
                $query = $connection->query("SELECT * FROM users");
                
                if($query->num_rows == 1 ){
                    echo 'No users found.';
                } else {
                    while($row = $query->fetch_assoc()){
                        $output .= '<a href="/xampp/htdocs/blue-pearl/portal/chatportal/index.php?id='.$row['anon_id'].'">
                        <div class="col">'.$row['username'].''.($row['status']).'
                        
                        </div>
                    </a>';
                        echo $output;
                    }
                } 
            }
                ?>