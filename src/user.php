<?php
/*
 * CREATE TABLE Users(
 * id int AUTO_INCREMENT,
 * name varchar(255),
 * email varchar(255) UNIQUE,
 * password char(60),
 * address varchar(255),
 * PRIMARY KEY(id)
 * );
 */
class User
{
    static private $connection;

    static public function SetConnection(mysqli $newConnection)
    {
        User::$connection = $newConnection;
    }
    static public function RegisterUser($newName, $newEmail, $password1, $password2, $newAddress)
    {
        if($password1 != $password2)
        {
            return false;
        }
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ];
        $hashedPassword = password_hash($password1, PASSWORD_BCRYPT, $options);

        $sql = "INSERT INTO Users (name, email, password, address)
        VALUES ('$newName', '$newEmail', '$hashedPassword', '$newAddress')";


        $result = self::$connection->query($sql);
        if($result === true)
        {
            $newUser = new User(self::$connection->insert_id, $newName, $newEmail, $newAddress);
            return $newUser;
        }
        return false;
    }

    static public function LogInUser($email, $password)
    {
        $sql = "SELECT * FROM Users WHERE email LIKE '$email'";
        $result = self::$connection->query($sql);

        if($result != false)
        {
            if($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();
                $isPasswordOk = password_verify($password, $row["password"]);
                if($isPasswordOk === true)
                {
                    $user = new User($row["id"], $row["name"], $row["email"], $row["description"]);
                    return $user;
                }
            }
        }
        return false;
    }

    private $id;
    private $name;
    private $email;
    private $address;

    public function __construct($newId, $newName, $newEmail, $newAddress)
    {
        $this->id = intval($newId);
        $this->name = $newName;
        $this->email = $newEmail;
        $this->setAddress($newAddress);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress ($newAddress)
    {
        if(is_string($newAddress))
        {
            $this->address = $newAddress;
        }

    }

    public function changeAddress($newAddress)
    {
        $sql = "UPDATE Users SET address='$newAddress' WHERE id = $this->id";
        $result = self::$connection->query($sql);
        if($result === true)
        {
            return true;
        }
        return false;
    }

    public function loadAllOrders()
    {
        $ret = [];
        $sql = "SELECT * FROM Orders WHERE id_user = ($this->id) ORDER BY post_date DESC";
        $result = self::$connection->query($sql);
        if($result != false)
        {
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $order = new Orders($row['id'], $row['id_user'], $row['xxxx'], $row['order_date']);
                    $ret[] = $order;
                }
            }
        }
        return $ret;
    }


}