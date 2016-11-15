<?php
/**
 * Created by PhpStorm.
 * User: Kaan
 * Date: 11/15/2016
 * Time: 2:12 PM
 */
namespace App\Controllers;

use App\Models\User;
use PDO;

class UserController
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function index($response)
    {
        $users = $this->db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_CLASS, User::class);

        return $response->withJson($users);
    }
}