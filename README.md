# ADMN-Letter

ADMN-Letter is a Laravel-based web application for managing official letter submissions in academic environments. It streamlines request submissions, approvals, and file downloads for students and admins.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/jethroGIT/admn-surat.git
   ```

2. **Install dependencies:**

   ```bash
   cd admn-surat
   composer install
   ```

3. **Configure Environment:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Import Database:**

   Import the provided `admn-surat.sql` file into your database. For example, using MySQL command line:
   
   ```bash
   mysql -u your_username -p your_database_name < admn-surat.sql
   ```
   
   Or use a tool like phpMyAdmin to import the SQL file.


## Usage

Start the development server:

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) in your browser.