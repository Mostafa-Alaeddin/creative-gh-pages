<?php

    //    Table Users
    $create_table_users = "CREATE TABLE IF NOT EXISTS `users`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        full_name       VARCHAR(80) NOT NULL,
        email           VARCHAR(100) NOT NULL UNIQUE ,
        password        VARCHAR(150) NOT NULL ,
        role            TINYINT DEFAULT(3),
        created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    //    Table Users about
    $create_table_about_section_one = "CREATE TABLE IF NOT EXISTS `about_section_one`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        image           VARCHAR(50) NOT NULL,
        title           VARCHAR(150) NOT NULL ,
        description     TEXT NOT NULL ,
        status          TINYINT DEFAULT(0),
        created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $create_table_about_section_two = "CREATE TABLE IF NOT EXISTS `about_section_two`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        title           VARCHAR(150) NOT NULL ,
        description     TEXT NOT NULL ,
        button           VARCHAR(50) NOT NULL,
        status          TINYINT DEFAULT(0)
    )";
    //    Table Users services
    $create_table_services_box = "CREATE TABLE IF NOT EXISTS `services_box`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        title           VARCHAR(150) NOT NULL UNIQUE ,
        description     TEXT NOT NULL ,
        status          TINYINT DEFAULT(0),
        created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $create_table_services_gallery = "CREATE TABLE IF NOT EXISTS `services_gallery`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        image           VARCHAR(50) NOT NULL,
        title           VARCHAR(150) NOT NULL ,
        description     TEXT NOT NULL ,
        status          TINYINT DEFAULT(0),
        created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";


    //    Table Users protofile
    $create_table_protofile = "CREATE TABLE IF NOT EXISTS `protofile`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        button           VARCHAR(50) NOT NULL,
        title           VARCHAR(150) NOT NULL
    )";
    //    Table Users contact
    $create_table_contact_details = "CREATE TABLE IF NOT EXISTS `contact_details`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        phone           VARCHAR(150) NOT NULL,
        title           VARCHAR(150) NOT NULL ,
        description     TEXT NOT NULL ,
        status          TINYINT DEFAULT(0),
        created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $create_table_contact_form = "CREATE TABLE IF NOT EXISTS `contact_form`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        full_name       VARCHAR(150) NOT NULL,
        email           VARCHAR(150) NOT NULL ,
        phone_number    VARCHAR(150) NOT NULL ,
        message         TEXT NOT NULL ,
        status          TINYINT DEFAULT(0),
        created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    //    Table Users footer
    $create_table_footer = "CREATE TABLE IF NOT EXISTS `footer`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        contact         VARCHAR(150) NOT NULL,
        status          TINYINT DEFAULT(0)
    )";
    //    Table Users header
    $create_table_brand = "CREATE TABLE IF NOT EXISTS `brand`(
        id              INT(24) AUTO_INCREMENT PRIMARY KEY,
        brand           VARCHAR(150) NOT NULL,
        src             VARCHAR(150) NOT NULL,
        status          TINYINT DEFAULT(0)
    )";