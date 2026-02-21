CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50),
    student_name VARCHAR(150),
    dob DATE,
    age INT,
    course VARCHAR(50),
    gender VARCHAR(20),
    guardian_name VARCHAR(150),
    phone VARCHAR(20),
    address TEXT,
    aadhaar VARCHAR(20),
    state VARCHAR(100),
    district VARCHAR(100),
    pin VARCHAR(20),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);