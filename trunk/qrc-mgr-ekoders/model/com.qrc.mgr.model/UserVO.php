<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserVO
 *
 * @author krisada.thiangtham
 */
class UserVO {

//put your code here
    private $firstName;
    private $lastName;
    private $companyName;
    private $email;
    private $username;
    private $password;
    private $detailAboutMe;
    private $address;
    private $city;
    private $state;
    private $zipcode;
    private $country;
    private $phonenumber;
    private $imgUrl;
    private $permissionType;

    public function __construct() {
        
    }

    function getPermissionType() {
        return $this->permissionType;
    }

    function setPermissionType($permissionType) {
        $this->permissionType = $permissionType;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getCompanyName() {
        return $this->companyName;
    }

    function getEmail() {
        return $this->email;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getDetailAboutMe() {
        return $this->detailAboutMe;
    }

    function getAddress() {
        return $this->address;
    }

    function getCity() {
        return $this->city;
    }

    function getState() {
        return $this->state;
    }

    function getZipcode() {
        return $this->zipcode;
    }

    function getCountry() {
        return $this->country;
    }

    function getPhonenumber() {
        return $this->phonenumber;
    }

    function getImgUrl() {
        return $this->imgUrl;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setCompanyName($companyName) {
        $this->companyName = $companyName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDetailAboutMe($detailAboutMe) {
        $this->detailAboutMe = $detailAboutMe;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;
    }

    function setImgUrl($imgUrl) {
        $this->imgUrl = $imgUrl;
    }

}
