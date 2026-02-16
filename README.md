# Legacy PHP Forum (Containerized)

![Infrastructure: Docker Compose](https://img.shields.io/badge/Infrastructure-Docker%20Compose-blue?style=flat-square&logo=docker)
![Environment: PHP 7.4](https://img.shields.io/badge/Environment-PHP%207.4-777bb4?style=flat-square&logo=php)
![Database: MySQL 8.0](https://img.shields.io/badge/Database-MySQL%208.0-4479a1?style=flat-square&logo=mysql)

A legacy forum application originally developed in XAMPP, now moved to a **modern, container-based setup** using Docker Compose.

## The Migration Story

### **Humble Beginnings (School Project)**
To be honest this is an old project I found on my disk. I wrote it some time ago for a school assignment where the teacher specifically required us to use **PHP**. It’s definitely not my best or most advanced code, but it is a perfect example for a **DevOps migration task**.

### **The DevOps Challenge**
* **Challenge:** Taking an old school project and making it run anywhere without installing XAMPP.
* **Solution:** **Splitting** the app into separate parts (PHP, MySQL) and making the setup automatic so it works for everyone.

## Tech Stack

* **Frontend:** HTML, CSS
* **Backend:** PHP 7.4 & Apache server.
* **Database:** MySQL 8.0.
* **Management:** Docker Compose.

## Docker - Quick Start

The application is fully containerized.

1.  **Run with Docker Compose:**
    ```sh
    docker compose up --build
    ```
2.  **Access the app:**
    Open [http://localhost:8081](http://localhost:8081) in your browser.

## Passwords & Security

**This is a demonstration project.**
To make it easy for you to run this app, I included **example passwords** in the `docker-compose.yml` file. 
* **In a real production environment**, passwords should **never** be kept in these files or uploaded to GitHub.
