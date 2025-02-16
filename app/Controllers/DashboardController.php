<?php

namespace Dannyokec\Realnaps\Controllers;

class DashboardController {
    protected $db;
    protected $blade;

    public function __construct($db, $blade) {
        $this->db = $db;
        $this->blade = $blade;
    }

    public function index() {
        echo $this->blade->make('dashboard', ['user' => 'John Doe'])->render();
    }
}
