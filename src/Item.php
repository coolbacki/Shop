<?php
/*
CREATE TABLE Items(
    id int AUTO_INCREMENT,
    name varchar(255) UNIQUE,
    description varchar(255),
    price float,
    quantity int,
    PRIMARY KEY(id)
);
*/
class Item
{
    static private $connection; //wspólne połączenie do bazy dla wszystkich userow
    static public function SetConnection(mysqli $newConnection)
    {
        Item::$connection = $newConnection;
    }

    static public function CreateItem($newName, $newDescription, $newPrice, $newQuantity)
    {
        $sql = "INSERT INTO Items(name, description, price, quantity)
                VALUES ('$newName', '$newDescription', '$newPrice', '$newQuantity')";

        $result = self::$connection->query($sql);
        if ($result === true) {
            $newItemId = self::$connection->insert_id;
            return $newItemId;
        }
        return false;
    }
    static public function UpdateItem($id, $newName, $newDescription, $newPrice, $newQuantity)
    {
        $sql = "UPDATE Items SET
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
    static public function DeleteItem($id)
    {

        $sql = "DELETE FROM Items WHERE id = '$id'";
        $result = self::$connection->query($sql);
        if ($result === true) {
            $deleted = "usuniete Baza danych";
            return $deleted;
        }
        return false;
    }
    static public function LoadFromDB($id = null)
    {
        $items = [];
        if (is_null($id)) {
            $sql = "SELECT * FROM Items";
        } else {
            $sql = "SELECT * FROM Items WHERE id = $id";
        }
        $result = self::$connection->query($sql);
        if ($result !== FALSE) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $items[] = $row;
                }
            }
            return $items;
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