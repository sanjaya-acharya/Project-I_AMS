<link rel="stylesheet" href="../../imports/css/navbar.css">
<script src="../../imports/js/navbar.js" defer></script>

<div class="navbar">
    <div class="menu-container">
        <div class="line-container">
            <div class="lines l1"></div>
            <div class="lines l2"></div>
            <div class="lines l3"></div>
        </div>
    </div>

    <a href='../dashboard/'><img class="project-logo" src="../../files/images/project-logo.png" alt="Project-Logo"></a>

    <div class="left-navitems">
        <img class="notification-icon" src="../../files/images/notification-icon.png" alt="Notification-Icon">

        <?php
            require_once('../../imports/notifications.php');
        ?>

        <div class="profile-container">
            <img class="profile-icon" src="../../files/images/profile-icon.png" alt="Profile">

            <div class="profile-menu-container">
                <a href="../view-profile/"><?= $_SESSION['username'] ?></a>
                <a href="../change-password/">Change Passsword</a>
                <a href="../../logouts-error/">Logout</a>
            </div>
        </div>
    </div>
</div>
