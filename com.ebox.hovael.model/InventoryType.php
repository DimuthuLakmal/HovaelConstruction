<?php

class InventoryType {

    private $id;
    private $category;
    private $make;
    private $model;
    private $capacity;
    private $country;
    private $status;

    function __construct($id, $category, $make, $model, $capacity, $country, $status) {
        $this->id = $id;
        $this->category = $category;
        $this->make = $make;
        $this->model = $model;
        $this->capacity = $capacity;
        $this->country = $country;
        $this->status = $status;
    }

    function getId() {
        return $this->id;
    }

    function getCategory() {
        return $this->category;
    }

    function getMake() {
        return $this->make;
    }

    function getModel() {
        return $this->model;
    }

    function getCapacity() {
        return $this->capacity;
    }

    function getCountry() {
        return $this->country;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setMake($make) {
        $this->make = $make;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}
?>