<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;
class ModuloController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function getModulos()
    {
        return Modulo::all();
    }
}
