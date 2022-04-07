<?php
    if(is_numeric(self::$request_url_array[3]))
    {
        $sql="UPDATE survey_stock SET amount = ? WHERE id = ?";
        $stmt=self::$Database->prepare($sql);
        if(!$stmt)
        {
            echo self::$Database->error();
            die();
        }
        $stmt->bind_param("ii", self::$filteredPost["amount"], self::$request_url_array[3]);
        $stmt->execute();
        $_SESSION["info"][]="Der Eintrag wurde erfolgreich aktualisiert.";
    }
?>