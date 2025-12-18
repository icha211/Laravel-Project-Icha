# Employee Management Performance System

A comprehensive Laravel-based Employee Management and Performance Tracking System with role-based access for employers and employees.

## Features

### 🔐 Authentication & Authorization
- **Dual-Role System**: Employer and Employee roles
- **Role-Based Access Control**: Different features and visibility based on user role
- **Secure Authentication**: Built-in Laravel authentication

### 👥 Employee Management (Employer)
- **Create Employees**: Add new employees with position, department, salary, and hire date
- **View All Employees**: Dashboard with employee list and performance metrics
- **Edit Employees**: Update employee information (phone, position, department, salary)
- **Delete Employees**: Remove employees from the system
- **Employee Details**: View comprehensive employee profile with performance history

### ⭐ Performance Reviews (Employer)
- **Create Reviews**: Rate employees on 5 criteria:
  - Communication
  - Teamwork
  - Productivity
  - Reliability
  - Leadership
- **Rating System**: 1-5 scale with automatic average calculation
- **Detailed Comments**: Add feedback and improvement suggestions
- **Edit & Delete**: Modify or remove reviews
- **Review History**: Track all performance reviews over time

### 🎯 Goals Management
- **Set Goals**: Create SMART goals with target dates
- **Track Progress**: Update progress percentage (0-100%)
- **Status Tracking**: Not Started, In Progress, Completed, Delayed
- **Priority Levels**: Low, Medium, High priority goals
- **Goal Details**: View, edit, and delete goals

### 📚 Training Programs (Creative Feature)
- **Training Tracking**: Schedule and track employee training programs
- **Certificate Management**: Record certificate numbers upon completion
- **Status Updates**: Scheduled, In Progress, Completed
- **Training History**: Monitor employee skill development

### 📊 Dashboards (Creative Feature)

#### Employer Dashboard
- **Statistics**: Total employees, top performers, recent reviews, departments
- **Top Performers**: List of highest-rated employees
- **Department Performance**: Performance metrics by department
- **Recent Reviews**: Latest performance review submissions
- **Analytics**: Visual representation of team performance

#### Employee Dashboard
- **Profile Overview**: Personal information and statistics
- **Performance Stats**: Average rating and review count
- **Recent Reviews**: Latest performance feedback
- **Goals Progress**: Visual progress bars for active goals
- **Training Programs**: Scheduled and completed trainings

### 🎨 Creative Features Implemented
1. **Performance Analytics**: Visual ratings and progress tracking
2. **Department-Level Analytics**: Department performance comparison
3. **Multi-Criteria Rating System**: Comprehensive performance evaluation
4. **Training & Development**: Track employee skill development
5. **Goal Progress Visualization**: Progress bars and status tracking
6. **Responsive Dashboard**: Different views for employers and employees
7. **Automated Rating Calculation**: Average ratings calculated from criteria

## Setup Instructions

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB or SQLite
- Laravel 11

### Installation

1. **Install Dependencies**
```bash
composer install
```

2. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Database Configuration**
Update your `.env` file with database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_management
DB_USERNAME=root
DB_PASSWORD=
```

4. **Run Migrations**
```bash
php artisan migrate
```

5. **Create Admin Employer Account (Optional)**
```bash
php artisan tinker
User::create([
    'name' => 'Admin Employer',
    'email' => 'employer@test.com',
    'password' => bcrypt('password'),
    'role' => 'employer'
]);
```

6. **Start Development Server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Default Login Credentials
After running seeders, you can use:
- **Employer**: employer@test.com / password
- **Employee**: employee@test.com / password

## Usage

### For Employers
1. Login as employer
2. Navigate to "Employees" to manage staff
3. Create new employee records
4. Navigate to "Performance" to create performance reviews
5. Rate employees on 5 criteria
6. View dashboard for team analytics

### For Employees
1. Login with employee credentials
2. View your profile and performance ratings
3. Track your goals and progress
4. Enroll in training programs
5. View feedback from employers

## Database Schema

### Users Table
- id, name, email, password, role, phone, department, position, created_at, updated_at

### Employees Table
- id, user_id, employer_id, employee_id, department, position, hire_date, salary, performance_rating, total_reviews, average_rating

### Performance Reviews Table
- id, employee_id, reviewer_id, rating, communication, teamwork, productivity, reliability, leadership, review_period, comments, status

### Goals Table
- id, employee_id, title, description, target_date, progress, status, priority

### Training Table
- id, employee_id, title, description, start_date, end_date, status, certificate

## API Endpoints

### Employees
- `GET /employees` - List all employees
- `POST /employees` - Create employee
- `GET /employees/{id}` - View employee details
- `PUT /employees/{id}` - Update employee
- `DELETE /employees/{id}` - Delete employee

### Performance Reviews
- `GET /performance-reviews` - List reviews
- `POST /performance-reviews` - Create review
- `GET /performance-reviews/{id}` - View review
- `PUT /performance-reviews/{id}` - Update review
- `DELETE /performance-reviews/{id}` - Delete review

### Goals
- `GET /employees/{id}/goals` - List goals
- `POST /employees/{id}/goals` - Create goal
- `GET /employees/{id}/goals/{goal}` - View goal
- `PUT /employees/{id}/goals/{goal}` - Update goal
- `DELETE /employees/{id}/goals/{goal}` - Delete goal

### Training
- `GET /employees/{id}/training` - List training
- `POST /employees/{id}/training` - Create training
- `GET /employees/{id}/training/{training}` - View training
- `PUT /employees/{id}/training/{training}` - Update training
- `DELETE /employees/{id}/training/{training}` - Delete training

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── EmployeeController.php
│   │   ├── PerformanceReviewController.php
│   │   ├── GoalController.php
│   │   └── TrainingController.php
├── Models/
│   ├── User.php
│   ├── Employee.php
│   ├── PerformanceReview.php
│   ├── Goal.php
│   └── Training.php

database/
├── migrations/
│   ├── create_users_table
│   ├── create_employees_table
│   ├── create_performance_reviews_table
│   ├── create_goals_table
│   └── create_training_table

resources/views/
├── dashboard/
│   ├── employer.blade.php
│   └── employee.blade.php
├── employees/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── performance-reviews/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── goals/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── training/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
└── app-layout.blade.php
```

## Technologies Used

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Sanctum
- **Styling**: Custom CSS + Bootstrap

## Security Features

- CSRF Protection
- SQL Injection Prevention via Eloquent ORM
- Password Hashing using bcrypt
- Role-based Authorization
- Input Validation

## Future Enhancements

- Email notifications for performance reviews
- Export reports to PDF
- Performance history charts
- 360-degree feedback system
- Salary management module
- Leave management
- Attendance tracking
- Performance improvement plans
- Competency mapping

## Support

For issues or feature requests, please create an issue in the repository.

## License

This project is open-sourced software licensed under the MIT license.

---

**Created with ❤️ for Better Employee Performance Management**
