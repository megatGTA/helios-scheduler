# Helios Scheduler Module

This repository contains the **Schedule Optimization Module** for the **Helios System**, developed for Global Turbine Asia.  
It provides the backend logic for **Work Orders**, **Task Scheduling**, **Technician Management**, and **CS Handover Tracking**.

---

## 🚀 Overview

The **Helios Scheduler Module** is a standalone Laravel backend service that supports:

- Work Order lifecycle management  
- Task scheduling under each Work Order  
- Real-time CS handover history  
- Technician role mapping  
- Data API for calendar & planning dashboards  
- To be integrated with the main Helios system  

Built with extensibility in mind, this module acts as the foundation for upcoming **schedule optimization**, **workforce planning**, and **calendar UI** features.

---

## 🧩 Tech Stack

- **Laravel:** 12.x  
- **PHP:** 8.x  
- **Database:** MySQL  
- **Frontend (next phase):** Blade + Tailwind + jQuery or Alpine.js  
- **Version Control:** Git + GitHub  

---

## 🧱 Database Schema (Core Tables)

| Table | Description |
|--------|-------------|
| `work_orders` | Stores work order details (priority, CS, engine info, date range) |
| `schedule_tasks` | Tasks belonging to each Work Order |
| `technicians` | Users with technician roles |
| `roles` | Defines roles (WM, CS, Admin) |
| `work_order_handover_logs` | Tracks each CS change event for traceability |

---

## ⚙️ Setup Instructions

### 1️⃣ Clone the repository

```bash
git clone https://github.com/megatGTA/helios-scheduler.git
cd helios-scheduler
```

### 2️⃣ Install dependencies

```bash
composer install
```

### 3️⃣ Create .env

```bash
cp .env.example .env
```

Update your MySQL credentials:

```env
DB_DATABASE=helios_schedule
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Migrate + Seed

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

### 5️⃣ Start server

```bash
php artisan serve
```

➡️ API Base URL:

```
http://127.0.0.1:8000/api/
```

---

## 🌱 Database Seeders (Included)

The project includes demo seeders:

| Seeder | Description |
|--------|-------------|
| `RoleSeeder` | Creates WM + CS roles |
| `UserSeeder` | Creates mock WM + CS users |
| `TechnicianSeeder` | Maps users → technicians |

Run:

```bash
php artisan migrate:fresh --seed
```

---

## 🧠 API Endpoints

### 🔹 Work Orders

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/work-orders` | List all Work Orders |
| POST | `/api/work-orders` | Create Work Order |
| GET | `/api/work-orders/{id}` | View Work Order |
| PUT | `/api/work-orders/{id}` | Update Work Order (includes auto-handover logic) |
| POST | `/api/work-orders/{id}/handover` | Perform Work Order handover |
| GET | `/api/work-orders/{id}/handover-logs` | View handover history |

### 🔹 Schedule Tasks

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/schedule-tasks` | List all tasks |
| POST | `/api/schedule-tasks` | Create task under Work Order |
| GET | `/api/schedule-tasks/{id}` | View task |
| PUT | `/api/schedule-tasks/{id}` | Update task |

Tasks automatically inherit the `cs_id` of their Work Order.

### 🔹 Technicians & Roles

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/technicians` | List technicians |
| POST | `/api/technicians` | Register technician |
| GET | `/api/roles` | List roles |
| POST | `/api/roles` | Create role |

---

## 🔄 Work Order Handover – Example

### POST `/api/work-orders/{id}/handover`

**Request:**

```json
{
  "new_cs_id": 3,
  "reason": "Transfer to CS Zahid due to workload"
}
```

**Response:**

```json
{
  "message": "Work Order handed over successfully.",
  "data": {
    "id": 1,
    "cs_id": 3,
    "schedule_tasks": [
      { "id": 1, "cs_id": 3 }
    ]
  }
}
```

### GET `/api/work-orders/{id}/handover-logs`

```json
{
  "work_order_id": 1,
  "handover_logs": [
    {
      "old_cs_id": 2,
      "new_cs_id": 3,
      "reason": "Transfer to CS Zahid due to workload",
      "changed_at": "2025-11-18 07:59:48"
    }
  ]
}
```

---

## 📘 Example Work Order Response

```json
{
  "id": 1,
  "title": "WO Test 04",
  "priority": 1,
  "cs": { "name": "CS Ahmad" },
  "schedule_tasks": [
    {
      "task_name": "Check Fuel Nozzle",
      "status": "pending",
      "cs": { "name": "CS Ahmad" }
    }
  ]
}
```

---

## 👨‍💻 Developer Notes

- **Developer:** Megat  
- **Project:** Helios — Schedule Optimization Module  
- **Backend:** Completed  

### Next Phase:
- ✅ Calendar UI (Blade)  
- ✅ Planning Dashboard  
- ✅ Optimization Engine  

---

## 🌟 Next Phase (Frontend)

After backend is stable, UI development will begin:

### Upcoming UI Pages
- Calendar Schedule View  
- Planning Dashboard  
- Workforce Allocation Matrix  
- Optimization Workspace  

---

## 📝 License

This project is proprietary and confidential. Developed for Global Turbine Asia.

---

## 🤝 Contributing

For internal development only. Contact the project maintainer for access.

---

## 📧 Contact

For questions or support, reach out to the development team.