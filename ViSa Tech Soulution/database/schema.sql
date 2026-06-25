-- ViSaTech Solutions - Complete Database Schema
-- Import via phpMyAdmin or: mysql -u root < schema.sql

CREATE DATABASE IF NOT EXISTS visatech_solutions
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE visatech_solutions;

-- 1. Admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Founders
CREATE TABLE IF NOT EXISTS founders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    designation VARCHAR(100) NOT NULL,
    skills TEXT,
    profile_image VARCHAR(255) DEFAULT NULL,
    bio TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Services
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(50) DEFAULT 'bi-code-slash',
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Technologies
CREATE TABLE IF NOT EXISTS technologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0
);

-- 5. Projects (Portfolio)
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    technologies VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    github_link VARCHAR(255) DEFAULT NULL,
    live_demo_link VARCHAR(255) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Testimonials
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    company_name VARCHAR(100),
    designation VARCHAR(100),
    review TEXT NOT NULL,
    rating TINYINT NOT NULL DEFAULT 5,
    is_approved TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Contact Messages
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(20),
    service_required VARCHAR(100),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. Careers
CREATE TABLE IF NOT EXISTS careers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT,
    location VARCHAR(100) DEFAULT 'Remote',
    job_type VARCHAR(50) DEFAULT 'Full-time',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 9. Job Applications
CREATE TABLE IF NOT EXISTS job_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    career_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(20),
    resume_file VARCHAR(255) NOT NULL,
    cover_letter TEXT,
    status ENUM('pending','reviewed','shortlisted','rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (career_id) REFERENCES careers(id) ON DELETE CASCADE
);

-- 10. Clients
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    company_name VARCHAR(100),
    phone VARCHAR(20),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 11. Project Tracking
CREATE TABLE IF NOT EXISTS project_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    project_name VARCHAR(150) NOT NULL,
    description TEXT,
    status ENUM('Requirement Analysis','UI Design','Development','Testing','Deployment','Completed') DEFAULT 'Requirement Analysis',
    progress INT DEFAULT 0,
    document_file VARCHAR(255) DEFAULT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

-- 12. Blog Posts
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255) DEFAULT NULL,
    author VARCHAR(100) DEFAULT 'ViSaTech Solutions',
    is_published TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Default admin created by setup.php (username: admin, password: admin123)

-- Founders
INSERT INTO founders (name, designation, skills, bio, sort_order) VALUES
('Vivek Matale', 'Co-Founder & Full Stack Developer', 'Full Stack Development, Java Development, Python Development, Database Management', 'Co-founder of ViSaTech Solutions with extensive experience in full stack development and database management.', 1),
('Sagar', 'Co-Founder & Software Engineer', 'MERN Stack Development, Backend Development, Java Development, Software Architecture', 'Co-founder specializing in MERN stack, backend systems, and scalable software architecture.');

-- Services
INSERT INTO services (title, description, icon, sort_order) VALUES
('Full Stack Development', 'Complete frontend and backend solutions for modern web applications.', 'bi-layers', 1),
('MERN Stack Development', 'MongoDB, Express.js, React.js, and Node.js full stack applications.', 'bi-stack', 2),
('Java Development', 'Scalable and secure enterprise business applications with Java.', 'bi-cup-hot', 3),
('Python Development', 'Automation, APIs, backend systems, and data-driven applications.', 'bi-filetype-py', 4),
('.NET Development', 'Enterprise-grade applications using ASP.NET Core and C#.', 'bi-microsoft', 5),
('UI/UX Design', 'Modern, user-friendly interface design for exceptional experiences.', 'bi-palette', 6),
('Website Development', 'Responsive, professional business websites that drive results.', 'bi-globe', 7),
('API Development', 'RESTful API design, development, and third-party integrations.', 'bi-plug', 8),
('Database Design', 'Database architecture, optimization, and management solutions.', 'bi-database', 9),
('Software Maintenance', 'Continuous monitoring, updates, and long-term support services.', 'bi-headset', 10);

-- Technologies
INSERT INTO technologies (category, name, sort_order) VALUES
('Frontend', 'HTML', 1), ('Frontend', 'CSS', 2), ('Frontend', 'JavaScript', 3),
('Frontend', 'Bootstrap', 4), ('Frontend', 'React', 5),
('Backend', 'PHP', 1), ('Backend', 'Node.js', 2), ('Backend', 'Java', 3),
('Programming', 'Python', 1), ('Programming', 'Java', 2), ('Programming', 'C#', 3),
('Database', 'MySQL', 1), ('Database', 'SQL Server', 2),
('Tools', 'GitHub', 1), ('Tools', 'VS Code', 2), ('Tools', 'Postman', 3);

-- Sample Projects
INSERT INTO projects (project_name, description, technologies, github_link, live_demo_link) VALUES
('E-Commerce Platform', 'Full-featured online store with payment integration and admin dashboard.', 'PHP, MySQL, Bootstrap, JavaScript', '#', '#'),
('Business Management System', 'ERP solution for SMEs with reporting and analytics modules.', 'ASP.NET Core, C#, SQL Server', '#', '#'),
('Real-Time Chat App', 'Scalable messaging platform with real-time notifications.', 'MERN Stack, Socket.io, MongoDB', '#', '#'),
('Healthcare Portal', 'Patient management with appointment scheduling and records.', 'Java, Spring Boot, MySQL', '#', '#'),
('Task Management App', 'Collaborative project tool with kanban boards.', 'React, Node.js, PostgreSQL', '#', '#');

-- Sample Testimonials (approved)
INSERT INTO testimonials (client_name, company_name, designation, review, rating, is_approved) VALUES
('Rajesh Kumar', 'TechStart India', 'CEO', 'ViSaTech Solutions delivered our project on time with exceptional quality. Highly recommended!', 5, 1),
('Sarah Mitchell', 'GlobalSoft Inc.', 'Product Manager', 'Professional team that built a scalable solution exceeding our expectations.', 5, 1),
('Amit Patel', 'InnovateHub', 'Founder', 'They transformed our idea into a fully functional product with clear communication.', 5, 1),
('David Chen', 'DataFlow Systems', 'CTO', 'Outstanding technical expertise and clean code quality throughout the project.', 5, 1);

-- Career Openings
INSERT INTO careers (job_title, description, requirements, location, job_type) VALUES
('Full Stack Developer', 'Build end-to-end web applications using modern frameworks and best practices.', '2+ years experience, HTML/CSS/JS, PHP or Node.js, MySQL', 'Remote', 'Full-time'),
('MERN Stack Developer', 'Develop scalable applications using MongoDB, Express, React, and Node.js.', 'Experience with MERN stack, REST APIs, Git', 'Remote', 'Full-time'),
('Java Developer', 'Design and develop enterprise Java applications and microservices.', 'Java, Spring Boot, SQL, 2+ years experience', 'Remote', 'Full-time'),
('Python Developer', 'Build backend systems, APIs, and automation tools with Python.', 'Python, Django/FastAPI, SQL, problem-solving skills', 'Remote', 'Full-time'),
('.NET Developer', 'Create enterprise web applications using ASP.NET Core and C#.', 'C#, ASP.NET Core, SQL Server, MVC pattern', 'Remote', 'Full-time');

-- Sample Blog Posts
INSERT INTO blog_posts (title, slug, excerpt, content, author, is_published) VALUES
('Why Choose Custom Software Development', 'why-custom-software-development',
 'Discover the benefits of custom software solutions for your business growth.',
 '<p>Custom software development offers tailored solutions that off-the-shelf products cannot match. At ViSaTech Solutions, we build applications designed specifically for your business processes, ensuring maximum efficiency and scalability.</p><p>From startups to enterprises, custom software helps you gain competitive advantages, improve workflows, and adapt quickly to market changes.</p>',
 'ViSaTech Solutions', 1),
('Top Technology Trends in 2026', 'technology-trends-2026',
 'Explore the latest technology trends shaping the software development industry.',
 '<p>The software industry continues to evolve rapidly. Key trends include AI-powered development tools, cloud-native architectures, microservices, and enhanced cybersecurity practices.</p><p>Staying ahead of these trends helps businesses make informed technology decisions and build future-proof applications.</p>',
 'ViSaTech Solutions', 1),
('MERN Stack vs Traditional LAMP Stack', 'mern-vs-lamp-stack',
 'A comparison guide to help you choose the right technology stack.',
 '<p>Choosing between MERN and LAMP depends on your project requirements. MERN offers JavaScript across the stack with excellent real-time capabilities, while LAMP provides proven stability with PHP and MySQL.</p><p>Our team at ViSaTech Solutions can help you evaluate both options for your specific use case.</p>',
 'ViSaTech Solutions', 1);
