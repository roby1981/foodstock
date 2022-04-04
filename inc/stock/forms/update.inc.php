<?php
include($_SERVER["DOCUMENT_ROOT"]."/html/stock_top_menu.html");
echo "<ul>";
$sql="SELECT id, product, full_amount, shortcut, resizeable, purchase_date FROM survey_stock;";
$result=self::$Database->query($sql);
while($data=$result->fetch_assoc())
{
    $full_amount=$data["full_amount"];
    if ($data["resizeable"])
    {
        $full_amount=resize($data["full_amount"]);
    }   $date = new DateTime($data["purchase_date"]);
    
    echo "<li><a href=\"http://".$_SERVER["HTTP_HOST"]."/stock/update/".$data["id"]."\">".$data["product"]."</a> ".$full_amount.$data["shortcut"]." gekauft am ".$date->format("d.m.Y")."</li>\n";
}
echo "</ul>";

if(isset($request_url_array[3]) && is_numeric($request_url_array[3]))
{
    $sql="SELECT product, amount, measure, shortcut, resizeable, packaging, generic, basic_amount, user, purchase_date, full_amount, best_before_date FROM survey_stock WHERE id = ?";
    $stmt=self::$Database->prepare($sql);
    $stmt->bind_param("i", $request_url_array[3]);
    $stmt->execute();
    $result=$stmt->get_result();
    $data=$result->fetch_assoc();
    if(!is_array($data))
    {
        $_SESSION["info"][]="Der Eintrag wurde nicht gefunden.";
        die();
    }
    extract($data);
    
    if($resizeable)
    {
        $measure=resize($basic_amount);
    }
    $date=new DateTime($purchase_date);
    $date=$date->format("d.m.Y");
    
    $bestbefore=new DateTime($best_before_date);
    $bestbefore=$bestbefore->format("d.m.Y");
    ?>
<form action="http://<?=$_SERVER["HTTP_HOST"]."/stock/update/".$request_url_array[3]?>" method="post">
    <table>
    <tr><th>Produkt:</th><td><?=$product?></td></tr>
    <tr><th>Menge:</th><td><input type="number" name="amount" min="0" value="<?=$amount?>"></td></tr>
    <tr><th>Einzelmenge:</th><td><?=$measure.$shortcut?></td></tr>
    <tr><th>Lagerung:</th><td><?=$packaging?></td></tr>
    <tr><th>Oberbegriff:</th><td><?=$generic?></td></tr>
    <tr><th>Eingetragen am:</th><td><?=$date?></td></tr>
    <tr><th>Haltbar bis:</th><td><?=$bestbefore?></td></tr>
    <tr><th>Eingetragen von:</th><td><?=$user?></td></tr>
    </table>
    <input type="submit" value="&Auml;nderungen speichern">
</form>
    <?php
}
?>