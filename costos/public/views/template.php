<?php

//$start = 0; // Starting index for pagination
//$count = 10; // Number of projects to fetch
$portfolio = ControllerPortfolio::ctrShowPortfolio();
//$projects = ControllerPortfolio::ctrShowProject($start, $count);
$experience = ControllerPortfolio::ctrShowExperience();
$education = ControllerPortfolio::ctrShowEducation();
//echo '<pre>'; print_r($education); echo '</pre>';

$keywords = json_decode($portfolio["keywords"], true);

$kwords = "";

foreach ($keywords as $key => $value) {
  $kwords .= $value.", ";
}
$kwords = substr($kwords,0,-2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Developer Portfolio">
  <meta name="keywords" content="<?php echo $kwords; ?>">
  <title>Developer Portfolio</title>
  
  <link rel="icon" href="views/img/logo_ico.png">
  <link href="views/css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide-icons@0.285.0/dist/umd/lucide.min.css">
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.285.0/dist/umd/lucide.min.js"></script>
  <script src="views/js/lucide.min.js"></script>
  <script type="module" src="views/js/errorHandling.js"></script>

</head>
<body>

<?php 


/*=============================================
Upper modules
=============================================*/
include "pages/modules/header.php";
include "pages/modules/hero.php";

/*=============================================
Navigate between pages
=============================================*/

if (isset($_GET["page"])) {
  if ($_GET["page"] == "portfolio" || $_GET["page"] == "contact") {
    include "pages/".$_GET["page"].".php";
  } else {
    include "pages/error404.php";
  }
} else {
  include "pages/start.php";
}



/*=============================================
Lower modules
=============================================*/
include "pages/modules/footer.php";
include "pages/modules/nav_indicator.php";
include "pages/modules/projects_modal.php";
include "pages/modules/toast_notification.php";

?>

<!-- js -->
<script type="text/javascript" src="views/js/script.js"></script>

</body>
</html>