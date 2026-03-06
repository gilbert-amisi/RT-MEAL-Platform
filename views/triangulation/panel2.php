<div class="row">
    <?php
        if (isset($_GET['sub'])) {
            if ($_GET['sub']==sha1("start")) {
                include 'bloc2.php';
            } else if ($_GET['sub']==sha1("view")) {
                include 'viewTriangulationDetails.php';
            }
        }
        
        
    ?>
    
</div>
