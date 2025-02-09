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
