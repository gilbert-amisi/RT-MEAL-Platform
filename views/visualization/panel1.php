<div class="row" style="height:65vh;overflow:scroll;">
    <?php
        if (isset($_GET['sub'])) {
            if (($_GET['sub'])==sha1("start")) {
                include 'viewStat.php';
            }
            
        }
        
        
    ?>
    
</div>

