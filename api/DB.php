<?php
namespace App;

use mysqli;

class DB {
    public $link;

    public function __construct() {
        $this->link = new mysqli("localhost", "root", "", "pract_shop");
    }

    public function escape_all(&...$params) {
        foreach ($params as &$param) {
            $param = $this->link->real_escape_string($param);
        }
    }

    public function get_good_by_id($id) {
        $id = $this->link->real_escape_string($id);
        $result = $this->link->query("SELECT * FROM `goods` WHERE id = '$id'");

        if ($result && $result->num_rows) {
            return $result->fetch_assoc();
        }
        return [];
    }

    public function check_new_login($login) {
        $this->escape_all($login);
        $user = $this->link->query("SELECT * FROM `users` WHERE `Login` = '$login'");
        return $user && $user->num_rows;
    }

    public function add_user($login, $password, $name) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->escape_all($login, $password, $name);
        $this->link->query("INSERT INTO `users` (`Login`, `Password`, `Name`) VALUES ('$login', '$password', '$name');");
    }

    public function get_user_by_login($login) {
        $this->escape_all($login);
        $user = $this->link->query("SELECT * FROM `users` WHERE `Login` = '$login'");
        if ($user && $user->num_rows) {
            return $user->fetch_assoc();
        }
        return [];
    }

    public function get_all_goods() {
        $result = $this->link->query("SELECT * FROM `goods`");
        if ($result && $result->num_rows) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function get_filtred_goods($category_id) {
        $category_id = $this->link->real_escape_string($category_id);
        $result = $this->link->query("SELECT * FROM `goods` WHERE `category_id` = '$category_id'");
        if ($result && $result->num_rows) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function get_categories() {
        $result = $this->link->query("SELECT * FROM `categories`");
        if ($result && $result->num_rows) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function get_goods_by_query($query) {
        $query = $this->link->real_escape_string($query);
        $result = $this->link->query("SELECT * FROM `goods` WHERE `Name` like '%$query%'");
        if ($result && $result->num_rows) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
}
