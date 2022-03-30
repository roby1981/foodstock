<?php
    if(is_numeric($request_url_array[3]))
    {
        $sql="UPDATE survey_stock SET amount = ? WHERE id = ?";
        $stmt=$Database->prepare($sql);
        if(!$stmt)
        {
            echo $Database->error();
            die();
        }
        $stmt->bind_param("ii", $filteredPost["amount"], $request_url_array[3]);
        $stmt->execute();
        $_SESSION["info"][]="Der Eintrag wurde erfolgreich aktualisiert.";
    }
?>