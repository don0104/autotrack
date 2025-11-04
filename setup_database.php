<?php
// Simple database setup script for AutoTrack Car Rental System
require_once 'index.php';

try {
    // Create database if it doesn't exist
    $pdo = new PDO('mysql:host=localhost', 'root', '');
    $pdo->exec("CREATE DATABASE IF NOT EXISTS car_rentalDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database 'car_rentalDB' created successfully!\n";
    
    // Connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=car_rentalDB;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create admins table
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Admins table created successfully!\n";
    
    // Create users table (for customers)
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        phone VARCHAR(20),
        password VARCHAR(255) NOT NULL,
        license_number VARCHAR(50),
        address TEXT,
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Users table created successfully!\n";
    
    // Create cars table
    $sql = "CREATE TABLE IF NOT EXISTS cars (
        id INT AUTO_INCREMENT PRIMARY KEY,
        make VARCHAR(100) NOT NULL,
        model VARCHAR(100) NOT NULL,
        year INT(4) NOT NULL,
        color VARCHAR(50) NOT NULL,
        plate_number VARCHAR(20) NOT NULL UNIQUE,
        vin VARCHAR(17) NOT NULL UNIQUE,
        mileage INT(11) NOT NULL,
        fuel_type ENUM('gasoline', 'diesel', 'hybrid', 'electric') DEFAULT 'gasoline',
        transmission ENUM('manual', 'automatic') DEFAULT 'automatic',
        seating_capacity INT(2) NOT NULL,
        daily_rate DECIMAL(10,2) NOT NULL,
        status ENUM('available', 'rented', 'maintenance', 'out_of_service') DEFAULT 'available',
        image_path VARCHAR(255),
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Cars table created successfully!\n";
    
    // Create rentals table
    $sql = "CREATE TABLE IF NOT EXISTS rentals (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        car_id INT NOT NULL,
        rental_start DATETIME NOT NULL,
        rental_end DATETIME NOT NULL,
        actual_return DATETIME NULL,
        daily_rate DECIMAL(10,2) NOT NULL,
        total_days INT(11) NOT NULL,
        subtotal DECIMAL(10,2) NOT NULL,
        tax_rate DECIMAL(5,2) DEFAULT 12.00,
        tax_amount DECIMAL(10,2) NOT NULL,
        total_amount DECIMAL(10,2) NOT NULL,
        status ENUM('pending', 'confirmed', 'active', 'completed', 'cancelled') DEFAULT 'pending',
        pickup_location VARCHAR(255) NOT NULL,
        return_location VARCHAR(255) NOT NULL,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Rentals table created successfully!\n";
    
    // Create payments table
    $sql = "CREATE TABLE IF NOT EXISTS payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        rental_id INT NOT NULL,
        user_id INT NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        payment_method ENUM('cash', 'credit_card', 'debit_card', 'bank_transfer') NOT NULL,
        payment_status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
        transaction_id VARCHAR(255),
        payment_date DATETIME NULL,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (rental_id) REFERENCES rentals(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Payments table created successfully!\n";
    
    // Insert sample cars
    $cars = [
        [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2023,
            'color' => 'Silver',
            'plate_number' => 'ABC-1234',
            'vin' => '1HGBH41JXMN109186',
            'mileage' => 15000,
            'fuel_type' => 'gasoline',
            'transmission' => 'automatic',
            'seating_capacity' => 5,
            'daily_rate' => 2500.00,
            'status' => 'available',
            'description' => 'Comfortable sedan perfect for city driving'
        ],
        [
            'make' => 'Honda',
            'model' => 'Civic',
            'year' => 2022,
            'color' => 'White',
            'plate_number' => 'DEF-5678',
            'vin' => '2HGBH41JXMN109187',
            'mileage' => 25000,
            'fuel_type' => 'gasoline',
            'transmission' => 'manual',
            'seating_capacity' => 5,
            'daily_rate' => 2200.00,
            'status' => 'available',
            'description' => 'Sporty compact car with great fuel efficiency'
        ],
        [
            'make' => 'Ford',
            'model' => 'Explorer',
            'year' => 2023,
            'color' => 'Black',
            'plate_number' => 'GHI-9012',
            'vin' => '3HGBH41JXMN109188',
            'mileage' => 12000,
            'fuel_type' => 'gasoline',
            'transmission' => 'automatic',
            'seating_capacity' => 7,
            'daily_rate' => 3500.00,
            'status' => 'available',
            'description' => 'Spacious SUV ideal for family trips'
        ]
    ];
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO cars (make, model, year, color, plate_number, vin, mileage, fuel_type, transmission, seating_capacity, daily_rate, status, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($cars as $car) {
        $stmt->execute([
            $car['make'],
            $car['model'],
            $car['year'],
            $car['color'],
            $car['plate_number'],
            $car['vin'],
            $car['mileage'],
            $car['fuel_type'],
            $car['transmission'],
            $car['seating_capacity'],
            $car['daily_rate'],
            $car['status'],
            $car['description']
        ]);
    }
    echo "Sample cars inserted successfully!\n";
    
    echo "\n✅ Database setup completed successfully!\n";
    echo "You can now:\n";
    echo "1. Register an admin account at: http://localhost:8000/admin/register\n";
    echo "2. Login as admin at: http://localhost:8000/admin/login\n";
    echo "3. Register as customer at: http://localhost:8000/user/register\n";
    echo "4. Login as customer at: http://localhost:8000/user/login\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
