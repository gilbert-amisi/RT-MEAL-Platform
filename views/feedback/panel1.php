<div class="row" style="height:65vh;overflow:scroll;">
    <?php
        if (isset($_GET['sub'])) {
            if (($_GET['sub'])==sha1("start")) {
                include 'bloc1.php';
            } else if (($_GET['sub'])==sha1("viewInformation")) {
                include 'viewInformation.php';
            } else if (($_GET['sub'])==sha1("viewTriangulation")) {
                include 'viewTriangulation.php';
            } else if (($_GET['sub'])==sha1("viewTriangulationDetails")) {
                include 'viewTriangulationDetails.php';
            } else if (($_GET['sub'])==sha1("add")) {
                include 'addFeedback.php';
            } else if (($_GET['sub'])==sha1("viewFeedback")) {
                include 'viewFeedback.php';
            } else if (($_GET['sub'])==sha1("viewFeedbackDetails")) {
                include 'viewFeedbackDetails.php';
            } else if (($_GET['sub'])==sha1("list")) {
                include 'viewFeedback.php';
            } else if (($_GET['sub'])==sha1("validateFeedback")) {
                include 'validateFeedback.php';
            } else if (($_GET['sub'])==sha1("validation")) {
                include 'viewValidation.php';
            }

            else if (($_GET['sub'])==sha1("validationDetails")) {
                include 'viewValidationDetails.php';
            }

            else if (($_GET['sub'])==sha1("traite")) {
                include 'postFeedback.php';
            }

            else if (($_GET['sub'])==sha1("viewPost")) {
                include 'viewPost.php';
            }
            
            
        }
        
        
    ?>
    
</div>

