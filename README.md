---
## Helios Scheduler Module

This repository contains the **Schedule Optimization Module** for the **Helios System** — developed as part of Global Turbine Asia’s internal asset management and task scheduling system.

---

## 🚀 Overview

The **Helios Scheduler Module** provides a backend API for:
- Work Order Management  
- Task Scheduling and Assignment  
- Technician Role Tracking  
- Real-time Schedule Updates and Optimization  

It’s a modular **Laravel 12.x** backend designed to integrate seamlessly with the main Helios platform or operate as a standalone service for testing and API validation.

---

## 🧩 Tech Stack

- **Framework:** Laravel 12.x  
- **Language:** PHP 8.x  
- **Database:** MySQL  
- **Frontend (up next):** Blade + Tailwind CSS  
- **Version Control:** Git + GitHub  

---

## 🧱 Database Schema (Core Tables)

| Table | Description |
|--------|-------------|
| `work_orders` | Stores work order details (engine type, priority, due date, etc.) |
| `schedule_tasks` | Contains specific scheduled tasks under each work order |
| `technicians` | Technician profiles and assigned roles |
| `roles` | Defines roles (e.g., Technician, Supervisor) |
| `assignments` | Links technicians to schedule tasks |

---

## ⚙️ Setup Instructions

### 1️⃣ Clone the repository
```bash
git clone https://github.com/megatGTA/helios-scheduler.git
cd helios-scheduler
````

### 2️⃣ Install dependencies

```bash
composer install
```

### 3️⃣ Set up environment

Copy and configure your `.env`:

```bash
cp .env.example .env
```

Update database details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=helios_schedule
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Generate key and run migrations

```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

Your API is now running at:

```
http://127.0.0.1:8000/api/
```

---

## 🧠 API Endpoints

| Method | Endpoint              | Description                |
| ------ | --------------------- | -------------------------- |
| GET    | `/api/work-orders`    | List all work orders       |
| POST   | `/api/work-orders`    | Create a new work order    |
| GET    | `/api/schedule-tasks` | List all schedule tasks    |
| POST   | `/api/schedule-tasks` | Create a new schedule task |
| GET    | `/api/assignments`    | List all task assignments  |
| POST   | `/api/assignments`    | Assign technician to task  |
| GET    | `/api/technicians`    | List all technicians       |
| POST   | `/api/technicians`    | Register a technician      |
| GET    | `/api/roles`          | List all roles             |
| POST   | `/api/roles`          | Create new role            |

---

## 📦 Example Workflow

1️⃣ Create a **Work Order**
2️⃣ Add **Schedule Tasks** under it
3️⃣ Register **Technicians** and **Roles**
4️⃣ Assign Technicians to Tasks
5️⃣ Fetch via API to view the complete schedule hierarchy

---

## 📘 Example JSON Response

```json
{
  "id": 1,
  "title": "Engine Inspection A1",
  "description": "Full turbine inspection",
  "priority": 2,
  "engine_type": "CFM56",
  "tasks": [
    {
      "task_name": "Visual Inspection",
      "status": "pending",
      "technician": "Zahid",
      "role": "Technician"
    }
  ]
}
```

---

## 👨‍💻 Developer Notes

* Developer: **Megat**
* Project: **Helios - Schedule Optimization Module**
* Framework: Laravel 12.x
* Status: ✅ Backend Completed, UI Development Next

---

## 🌱 Next Phase

* Build the **Frontend UI Dashboard** (Blade + Tailwind)
* Implement **Schedule Optimization Logic**
* Add **WebSocket** for Real-time Status Updates




