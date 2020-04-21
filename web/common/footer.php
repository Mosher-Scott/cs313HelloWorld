        <footer>
            <div>
            <p><?php 
                echo "Today's date is: "; 
                $today = date("m/d/Y"); 
                echo $today; 
                ?> </p>
            <p><?php
                echo "You are currently using {$_SERVER['HTTP_USER_AGENT']} to view this page";
            ?>
            </div>
        </footer>
    </body>
</html>