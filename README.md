# Helios – Schedule Optimization Module

This repository contains the **Schedule Optimization Module** for the Helios system. The module is designed to focuses on **smart task scheduling**, **technician assignment**, and **visualization of work order timelines**.

This README explains the project purpose, tech stack, endpoints, and how to run the backend.

---

## 🚀 Project Overview

The **Helios Schedule Optimization Module** provides:

### ✅ 1. Work Order Management (extended)

* Adds **start date** and **due date** to Work Orders.
* Supports relationships to scheduled tasks.

### ✅ 2. Schedule Task Module

Each work order contains multiple tasks with:

* Task name
* Asset involved
* Dates (planned, start, due)
* Status tracking

### ✅ 3. Technician Assignment Module

Each task can be assigned to one or more technicians:

* Assignment time window
* Technician status
* Technician details relations

### ✅ 4. Data Served as JSON API

Fully optimized for AJAX-based frontend integrations.

This module is built to be **plug-and-play** so the third-party team can merge it into their main system.

---

## 🧱 Tech Stack

Backend technologies used:

* **Laravel 11 (PHP)** – backend framework
* **MySQL** – database
* **Eloquent ORM** – model relationships
* **REST API (JSON)** – data output for frontend
* **Artisan CLI** – migrations / seeders

---

## 📌 Database Architecture

### **1. Work Orders (`work_orders`)**

Fields include:

* `wo_number`
* `title`
* `description`
* `start_date`
* `due_date`
* `handover_to`
* `handover_reason`

### **2. Schedule Tasks (`schedule_tasks`)**

Each task belongs to a Work Order.

* `task_name`
* `asset_name`
* `planned_date`
* `start_date`
* `due_date`
* `status`

### **3. Assignments (`assignments`)**

Links technicians to schedule tasks.

* `technician_id`
* `start_time`
* `end_time`
* `status`

---

## 🔗 API Endpoints

### ✅ Work Orders

* `GET /api/work-orders` – list all WO
* `GET /api/work-orders/{id}` – get details including tasks

### ✅ Schedule Tasks

* `GET /api/schedule-tasks/{id}` – get task, work order, and technician assignment

### ✅ Assignments

* Designed to expand for future CRUD

---

## ▶️ How to Run the Project

### 1. Install composer packages

```
composer install
```

### 2. Copy environment file

```
cp .env.example .env
```

### 3. Generate key

```
php artisan key:generate
```

### 4. Run migrations + seeders

```
php artisan migrate:fresh --seed
```

### 5. Start local server

```
php artisan serve
```

Your API will run at:

```
http://localhost:8000
```

---

## 🧪 Postman Testing

All endpoints return **clean JSON responses** and are confirmed working.

Example response (Work Order): includes:

* Work Order details
* Schedule Tasks
* Technician assignments per task

---

## 📦 Deployment Note

The module is intentionally designed to be:

* Framework-aligned (Laravel standards)
* Easy for third-party devs to integrate
* Decoupled from other modules
* Able to adapt to another party's database schema if needed

---

## 🙌 Authors

Helios Schedule Optimization Module
Developed for **Global Turbine Asia (GTA)**, AMIC Project.
