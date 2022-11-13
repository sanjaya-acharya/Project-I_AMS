<link rel="stylesheet" href="../../imports/css/notifications.css">
<script src="../../imports/js/notifications.js" defer></script>

<?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
        $ownerID = $_SESSION['teacherID'];
    } else {
        $ownerID = $_SESSION['studentID'];
    }

    $sql = "SELECT * FROM notifications WHERE ownerID=? ORDER BY sentDate, sentTime";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ownerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    echo "<div class='notification-container'>
            <div class='notification-close-btn'>
                <div class='crossLine cl1'></div>
                <div class='crossLine cl2'></div>
            </div>";

        if ($result->num_rows == 0) {
            echo "<div class='no-notification notification-message'>No Notification!</div>";
        } else {
            echo "<div class='all-notifications'>
                    <div class='notification-title'>Notifications</div>
                </div>";
            while ($row = $result->fetch_assoc())
            {
                $sentTime = substr($row['sentTime'], 0, 5);

                echo "<div class='notification-bar'>
                        <div class='notification-message'>".$row['message']."</div>
                        <div class='lower-box'>
                            <div class='time'>".$row['sentDate'].", ".$sentTime."</div>
                        </div>
                    </div>";
            } 
        }			
    echo "</div>";
?>