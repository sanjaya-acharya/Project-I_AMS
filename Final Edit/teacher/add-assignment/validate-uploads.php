<?php
    function isValid($file_name, $file_size, $tmp_name, $error){
        if ($error === 0) {
            if ($file_size > 25*1024*1024 /* file must be less than 25MB */ ) {
                $_SESSION['create-assignment-error'] = "File too large!";
                return false;
            } else {
                $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_ex_lc = strtolower($file_ex);
                $allowed_exs = array("jpg", "jpeg", "png", "pdf", "docx");
    
                if (in_array($file_ex_lc, $allowed_exs)) {
                    return true;
                } else {
                    $_SESSION['create-assignment-error'] = "File not supported";
                    return false;
                }
            }
        } else {
            $_SESSION['create-assignment-error'] = "Unknown error occured!";
            return false;
        }
    }

?>