<?php
include './lib/Database.php';
$db = new Database();

?>
<option disabled selected value>Select number</option>

<?php
$query = "SELECT * FROM receiving_money_number";
$resultreceivingMoneyNumber = $db->select($query);
$i = 0;
if ($resultreceivingMoneyNumber) {
    while ($receivingMoneyNumber = $resultreceivingMoneyNumber->fetch_assoc()) {

        $i++;
        ?>
        <option>      <?php echo $receivingMoneyNumber['phone']; ?></option>

        <?php
    }
}
?>