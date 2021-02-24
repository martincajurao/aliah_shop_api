<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

// Declare the interface 
interface ControllerInterface
{
    public function index();
    public function save($payload, $id = null);
    public function destroy($id);
}
