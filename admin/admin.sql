CREATE TABLE package_departure_city (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_id INT NOT NULL,
    city_name VARCHAR(100) NOT NULL,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE
);
