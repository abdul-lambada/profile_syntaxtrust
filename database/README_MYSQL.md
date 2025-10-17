# MySQL Database Setup Guide - Profile Syntaxtrust

## Overview
This guide explains how to set up and use the MySQL database schema for the Profile Syntaxtrust project.

## Prerequisites
- MySQL 8.0+ or MariaDB 10.5+
- Access to MySQL command line or a MySQL client

## Database Setup

### Step 1: Create Database
```sql
CREATE DATABASE IF NOT EXISTS profile_syntaxtrust
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 2: Run Schema Script
Execute the `schema_mysql.sql` file:
```bash
mysql -u your_username -p profile_syntaxtrust < database/schema_mysql.sql
```

Or run the SQL commands from the file directly in your MySQL client.

### Step 3: Verify Installation
```sql
USE profile_syntaxtrust;
SHOW TABLES;
```

You should see all 10 tables created.

## MySQL vs PostgreSQL Differences

| Feature | PostgreSQL | MySQL |
|---------|------------|-------|
| **Primary Keys** | `BIGSERIAL` | `INT AUTO_INCREMENT` |
| **Timestamps** | `TIMESTAMP WITH TIME ZONE` | `TIMESTAMP` |
| **Arrays** | `TEXT[]` | `JSON` |
| **UUID** | `uuid-ossp` extension | `UUID()` function |
| **Triggers** | Standard | `ON UPDATE` clauses |

## Data Types Used

### **Numeric Types**
- `INT AUTO_INCREMENT` - Primary keys
- `DECIMAL(10,2)` - Monetary values (prices)

### **String Types**
- `VARCHAR(n)` - Variable length strings with max length
- `TEXT` - Long text content (descriptions, testimonials)

### **Date/Time Types**
- `TIMESTAMP` - Date and time with automatic updates
- `DATE` - Date only (project dates)
- `TIME` - Time only (booking times)

### **Special Types**
- `JSON` - Array-like data (features, etc.)
- `ENUM` - Constrained value sets (status, types)
- `BOOLEAN` - True/false flags

## Sample Usage

### **Insert Sample Data**
The schema includes sample data insertion. After running the schema:

```sql
-- Check if data was inserted
SELECT COUNT(*) FROM services;
SELECT COUNT(*) FROM pricing_packages;
SELECT COUNT(*) FROM service_categories;
```

### **Query Examples**

#### **Get Active Services**
```sql
SELECT s.*, sc.name as category_name
FROM services s
JOIN service_categories sc ON s.category_id = sc.id
WHERE s.is_active = true AND sc.is_active = true
ORDER BY sc.sort_order, s.sort_order;
```

#### **Get Portfolio with Images**
```sql
SELECT p.*, s.name as service_name,
       GROUP_CONCAT(si.image_path) as images
FROM portfolio_items p
JOIN services s ON p.service_id = s.id
LEFT JOIN service_images si ON p.id = si.portfolio_item_id
WHERE p.is_active = true
GROUP BY p.id;
```

#### **Check Available Booking Slots**
```sql
-- Using the stored function
SELECT get_available_slots(1, '2024-01-15', '09:00:00', '17:00:00');
```

## Maintenance

### **Backup Database**
```bash
mysqldump -u username -p profile_syntaxtrust > backup_$(date +%Y%m%d_%H%M%S).sql
```

### **Optimize Tables**
```sql
OPTIMIZE TABLE services;
OPTIMIZE TABLE bookings;
-- Run for all tables periodically
```

### **Check Database Size**
```sql
SELECT
    table_name,
    table_rows,
    data_length,
    index_length,
    (data_length + index_length) as total_size
FROM information_schema.tables
WHERE table_schema = 'profile_syntaxtrust'
ORDER BY total_size DESC;
```

## Common Issues & Solutions

### **JSON Column Issues**
If using MySQL < 5.7:
- Replace `JSON` columns with `TEXT` and handle JSON parsing in application
- Or use separate junction tables for array-like data

### **ENUM Limitations**
- ENUM values are case-sensitive in some MySQL versions
- Consider using `VARCHAR` with application-level validation for flexibility

### **Character Set Issues**
- Ensure database uses `utf8mb4` for full Unicode support
- Check connection encoding in your application

## Performance Tips

1. **Indexes**: The schema includes strategic indexes on frequently queried columns
2. **JSON Queries**: Use `JSON_EXTRACT()` for querying JSON columns efficiently
3. **Pagination**: Use `LIMIT` and `OFFSET` for large result sets
4. **Connection Pooling**: Use connection pooling in your application

## Integration with Application

### **Node.js/Express Example**
```javascript
const mysql = require('mysql2/promise');

const pool = mysql.createPool({
  host: 'localhost',
  user: 'your_user',
  password: 'your_password',
  database: 'profile_syntaxtrust',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Example query
const services = await pool.execute(
  'SELECT * FROM v_active_services ORDER BY sort_order'
);
```

### **PHP Example**
```php
<?php
$conn = new mysqli("localhost", "username", "password", "profile_syntaxtrust");

$result = $conn->query("SELECT * FROM services WHERE is_active = 1");
while($row = $result->fetch_assoc()) {
    echo $row['name'] . "<br>";
}
?>
```

This MySQL schema provides a complete, production-ready database foundation for your Profile Syntaxtrust project with full compatibility for MySQL/MariaDB environments.
