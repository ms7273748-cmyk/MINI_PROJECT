-- ClubSphere Database Schema
DROP DATABASE IF EXISTS club_management;
CREATE DATABASE club_management CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE club_management;

-- Users
CREATE TABLE users (
  user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Clubs
CREATE TABLE clubs (
  club_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Memberships
CREATE TABLE memberships (
  membership_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  club_id INT UNSIGNED NOT NULL,
  role ENUM('member','officer','owner') DEFAULT 'member',
  joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (user_id, club_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  FOREIGN KEY (club_id) REFERENCES clubs(club_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Events
CREATE TABLE events (
  event_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  club_id INT UNSIGNED,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  location VARCHAR(200),
  start_at DATETIME NOT NULL,
  end_at DATETIME,
  created_by INT UNSIGNED,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (club_id) REFERENCES clubs(club_id) ON DELETE SET NULL,
  FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Announcements
CREATE TABLE announcements (
  announcement_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  club_id INT UNSIGNED,
  title VARCHAR(150) NOT NULL,
  body TEXT NOT NULL,
  published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  created_by INT UNSIGNED,
  FOREIGN KEY (club_id) REFERENCES clubs(club_id) ON DELETE SET NULL,
  FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Sample Data
INSERT INTO clubs (slug, name, description) VALUES
('acm','ACM – Computing & Innovation','Leading coding culture with hackathons and workshops.'),
('mesa','MESA – Mechanical Engineers','Designing, building, and breaking limits.'),
('itsa','ITSA – Information Technology','Driving digital transformation.');

INSERT INTO announcements (club_id, title, body)
VALUES (NULL, 'Campus Clubs Orientation', 'Join us for the inter-club orientation this Friday.');
