# 🛒 **E-Commerce Website (PHP, MySQL, JavaScript)**
### **Full-Stack Shopping Platform with Admin Dashboard**

🚀 **A complete eCommerce website built using PHP, MySQL, HTML, CSS, and JavaScript.**  
This project includes **user authentication, product management, shopping cart functionality, order processing, and an admin dashboard** for managing users, products, and orders.

---

## 📌 **Features**
### **👤 User Features**
✅ **User Authentication** (Register, Login, Logout)  
✅ **Browse & Search Products** 📦  
✅ **Shopping Cart System** (Add, Remove, Update Quantity) 🛒  
✅ **Checkout & Order Placement** 🏷️  
✅ **View Order History** 📋  

### **🛠️ Admin Panel**
✅ **Admin Login System** 🔐  
✅ **Manage Users** (View, Delete) 👥  
✅ **Manage Products** (Add, Edit, Delete) 🏷️  
✅ **Manage Orders** (View, Update Status: Pending, Shipped, Delivered) 📦  

---

## 📂 **Project Structure**
```
ecommerce_project/
│── assets/
│   ├── css/ (Style files)
│   ├── images/ (Product images)
│── includes/
│   ├── db.php (Database connection)
│── admin_dashboard.php (Admin Panel)
│── admin_users.php (Manage Users)
│── admin_orders.php (Manage Orders)
│── admin_login.php (Admin Authentication)
│── index.php (Homepage)
│── product.php (Product Details Page)
│── cart.php (Shopping Cart)
│── checkout.php (Order Checkout)
│── register.php (User Registration)
│── login.php (User Login)
│── logout.php (User Logout)
│── order_success.php (Order Confirmation)
│── README.md (This File)
```

---

## 🛠️ **Technologies Used**
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP, MySQL  
- **Database:** MySQL (Using PDO for Secure Queries)  
- **Security:** Password Hashing, Prepared Statements  
- **Session Management:** User Authentication, Cart Storage  

---

## ⚙️ **Installation & Setup**
### **1️⃣ Clone the Repository**
```bash
git clone https://github.com/your-username/ecommerce_project.git
cd ecommerce_project
```

### **2️⃣ Setup Database**
- Import `ecommerce_db.sql` in **phpMyAdmin**  
- Configure database connection in **`includes/db.php`**  

```php
$host = 'localhost';
$dbname = 'ecommerce_db';
$username = 'root';
$password = '';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
```

### **3️⃣ Start XAMPP Server**
- Start **Apache & MySQL** from **XAMPP Control Panel**  
- Open in browser: `http://localhost/ecommerce_project/index.php`

---

## 📌 **Database Schema**
### **1️⃣ Create the Database**
```sql
CREATE DATABASE ecommerce_db;
USE ecommerce_db;
```

### **2️⃣ Users Table**
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### **3️⃣ Products Table**
```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### **4️⃣ Orders Table**
```sql
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    order_status ENUM('Pending', 'Shipped', 'Delivered') DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### **5️⃣ Order Items Table**
```sql
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

### **6️⃣ Shopping Cart Table** (Optional)
```sql
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

### **7️⃣ Admin Logs Table** (Optional)
```sql
CREATE TABLE admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    log_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 📌 **Future Improvements**
🔹 Add Payment Gateway (Stripe/PayPal) 💳  
🔹 Improve UI with Bootstrap/Tailwind 🎨  
🔹 Implement Wishlist Feature 💖  
🔹 Improve Security (CSRF Protection, HTTPS) 🔒  

---

## 📜 **License**
This project is **open-source** and free to use. Feel free to **contribute, modify, or improve**! 🚀  

---

💡 **Need Help?**  
Feel free to **open an issue** or reach out! 😊  
Happy Coding! 🎉✨
