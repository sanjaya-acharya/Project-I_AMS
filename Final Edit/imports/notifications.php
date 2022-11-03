<link rel="stylesheet" href="../../imports/css/notifications.css">
<script src="../../imports/js/notifications.js" defer></script>

<?php
    $sql = "SELECT * FROM notifications WHERE ownerID=? ORDER BY sentDate, sentTime";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['teacherID']);
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
                    <div class='delete-notification' onclick='deleteAllNotification'>Delete All</div>
                </div>";
            while ($row = $result->fetch_assoc())
            {
                $sentTime = substr($row['sentTime'], 0, 5);

                echo "<div class='notification-bar'>
                        <div class='notification-message'>".$row['message']."</div>
                        <div class='lower-box'>
                            <div class='time'>".$row['sentDate'].", ".$sentTime."</div>
                            <div class='go-left'>
                                <div name='".$row['notificationID']."' class='delete-notification' onclick='deleteNotification'>Delete</div>
                            </div>
                        </div>
                    </div>";
            } 
        }			
    echo "</div>";
?>