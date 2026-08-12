# Student Result Information System (SRIS)

A full-stack Web Application built using **Laravel** and **Bootstrap** that manages university student records, subject registrations, mark processing, and official mark certificate generation.

---

## 🌟 Key Features

### 👨‍🎓 Student Portal

- **Student Authentication:** Secure registration and login flow for students.
- **Dynamic Mark Certificate Application:** Filter subjects dynamically based on Academic Year, Year Level, Semester, and Specialization without page reloads.
- **Official Performance Certificate Generation:** Automatically calculates total marks, lists selected subject grades, and provides a print-ready view.
- **Semester Grade Lookup:** View full academic performance reports by inputting student credentials and class filters.

### 🔐 Admin Management Panel

- **Dashboard Overview:** Real-time summary metrics (Total Registered Students, Master Subjects Count).
- **Student Records Management:** Search, create, edit, view, and delete student profile records.
- **Subjects Master Data:** Manage global subject codes, credit hours, and subject names across specializations.
- **Course Registrations & Marks Management:** Manage course registration and mark, also grades ($A+, A, B+, \dots$), and maintain transcript history.

---

## 🛠️ Tech Stack

- **Backend Framework:** Laravel 10+ (PHP)
- **Frontend:** Blade Templating, HTML5, CSS3, JavaScript (Fetch API)
- **UI Framework:** Bootstrap 5
- **Database:** MySQL
- **Authentication:** Laravel Auth (Session & Middleware)

---

## 🚀 Getting Started

Follow these steps to set up the project locally:

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL Server

### Installation Steps

1. Clone the repository and navigate into the project:
   git clone https://github.com/tinphoowai/Student-Result-Management-System.git
   cd Student-Result-Management-System

2. Install PHP dependencies:
   composer install

3. Configure environment file:
   cp .env.example .env

4. Generate application key:
   php artisan key:generate

5. Setup database credentials inside .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sris_db
   DB_USERNAME=root
   DB_PASSWORD=

6. Run database migration and seeders:
   php artisan migrate --seed

7. Launch the server:
   php artisan serve

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).
