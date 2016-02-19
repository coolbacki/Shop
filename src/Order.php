<?php
/*
CREATE TABLE Orders(
    id int AUTO_INCREMENT,
    name varchar(255),
    description varchar(255),
    price float,
    quantity int,
    PRIMARY KEY(id)
);
*/

class Order
{
    static private $connection; //wspólne połączenie do bazy dla wszystkich userow
    static public function SetConnection(mysqli $newConnection)
    {
        Order::$connection = $newConnection;
    }

    static public function CreateOrder($newName, $newDescription, $newPrice, $newQuantity)
    {
        $sql = "INSERT INTO Orders(name, description, price, quantity)
                VALUES ('$newName', '$newDescription', '$newPrice', '$newQuantity')";

        $result = self::$connection->query($sql);
        if ($result === true) {
            $newOrderId = self::$connection->insert_id;
            return $newOrderId;
        }
        return false;
    }
    static public function UpdateOrder($id, $newName, $newDescription, $newPrice, $newQuantity)
    {
        $sql = "UPDATE Orders SET
            name ='$newName',
            description = '$newDescription'
            price = '$newPrice'
            quantity = '$newQuantity'
            WHERE id ='$id'";

        $result = self::$connection->query($sql);
        if ($result === true) {
            return "update Baza danych";
        }
        return false;
    }
    static public function DeleteOrder($id)
    {

        $sql = "DELETE FROM Orders WHERE id = '$id'";
        $result = self::$connection->query($sql);
        if ($result === true) {
            $deleted = "usuniete Baza danych";
            return $deleted;
        }
        return false;
    }
    static public function LoadFromDB($id = null)
    {
        $orders = [];
        if (is_null($id)) {
            $sql = "SELECT * FROM Orders";
        } else {
            $sql = "SELECT * FROM Orders WHERE id = $id";
        }
        $result = self::$connection->query($sql);
        if ($result !== FALSE) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $orders[] = $row;
                }
            }
            return $orders;
        } else {
            return false;
        }
    }
    
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;

    public function __construct()
    {
        $this->id = -1;
        $this->name = "";
        $this->description = "";
        $this->price = "";
        $this->quantity = "";

    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

}