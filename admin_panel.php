<?php
include "templates/header.php";
include "php/class/User.php";
include "php/class/DBConnection.php";
include "php/class/Adoption.php";

$user = new User();
if(!empty($_SESSION['id'])){
    $uid = $_SESSION['id'];

}
if($_SESSION['rola']!=="admin"){
    header("location:user_panel.php");
} 
if ($user->getSession()===FALSE) {
   header("location:login.php");
}
if (isset($_GET['q'])) {
    $user->logout();
    header("location:login.php");
}
$user->setID($uid);
$userInfo = $user->getUserInfo();
?>
      <div class="container-fluid hero-container-pages">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-light display-1">Witaj w panelu admina</h1>
            </div>
        </div>
      </div>
    <div class="container pt-5">
    <div class="row">
        <div class="col-lg-10">
            <h2>Witaj <?php print $userInfo['imie'];?></h2>                 
        </div>
        <div class="col-lg-2">
            <a href="<?php print SITE_URL; ?>admin_panel.php?q=logout" class="float-right btn btn-danger btn-sm">LOGOUT</a>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $ad = new Adoption();
                    $ad->setIdUzytkownik($user->getId());
                    $adopcje = $ad->getUserAdoptions();
                    foreach ($adopcje as $row){
                        echo "<p><strong>Adopcja: </strong>". $row['id']." status: ". $row["status"]."</p>";

                    }

                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <form action="" method="post">
                <a class="btn btn-primary"  href="" role="button">Zarządzaj płatnościami</a>
                <a class="btn btn-primary"  href="add_animal.php" role="button">Dodaj zwierzaka</a>
                <!--<button type="submit" class="btn btn-primary" name="add_animal">Dodaj zwierzaka</button>-->
            </form>

            </div>
        </div>
    </div>
    <?php
    /*if(isset($_POST['add_animal'])){
        include 'add_animal_copy.php';
    }*/
    ?>
<?php
    include "templates/footer.php";
?>