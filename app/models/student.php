<?php

  class Student {
    private $id;
    private $name;
    private $dob;
    private $active;

    public function __construct() {}

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getName() {
      return $this->name;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function getDob() {
      return $this->dob;
    }

    public function setDob($dob) {
      $this->dob = $dob;
    }

    public function getActive() {
      return $this->active;
    }
    public function setActive($active) {
      $this->active = $active;
    }
  }
