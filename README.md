# Salary Payment Tool

This is a Salary Payment Tool that exports salary and bonus payment data to CSV and Excel files. It is built using Laravel and utilizes the `PhpSpreadsheet` library for Excel file generation.

## Features

- Export salary payment data to CSV format
- Export salary payment data to Excel (XLSX) format
- Easily configurable with Laravel's `Storage` facade for saving files

## Requirements

- PHP 8.0 or higher
- Laravel 9.x or higher
- PhpOffice PhpSpreadsheet (for Excel export)
- Composer (for dependency management)

## Installation

To install and run this project locally, follow these steps:

### 1. Clone the repository

```
git clone https://github.com/syedarsalan9/salary-payment-tool.git
cd salary-payment-tool
```

### 2. Install dependencies
Make sure you have Composer installed on your machine. Then run the following command:

```

composer install
This will install all the required dependencies defined in composer.json.
```
### 3. Usage
This application provides an Artisan command to export salary payment data to both CSV and Excel formats. Below are the details:
Generate CSV
To generate a salary payment CSV file for a specific year, run the following Artisan command:
```
php artisan salary:generate 2026 csv
```
This will generate a CSV file named salary_payment_2026.csv in the configured storage path.

Generate Excel
To generate a salary payment Excel file for a specific year, run the following Artisan command:
```
php artisan salary:generate 2026 xlsx
```

### 4. Run the application
You can now run the Laravel development server:


```

php artisan serve
The application will be accessible at http://localhost:8000.
```

Running Tests
To run the tests for this project, including the export services:

```

php artisan test
Make sure you have PHPUnit installed as per composer.json.

Dependencies
This project relies on the following dependencies:

Laravel Framework
PhpOffice PhpSpreadsheet (for handling Excel files)
PHPUnit (for running tests)
All dependencies are managed by Composer, and they can be found in the composer.json file.