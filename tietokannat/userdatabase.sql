-- Create the database
CREATE DATABASE UserDatabase;
USE UserDatabase;

-- Create the Users table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    ProfilePicture VARCHAR(255)
);

-- Insert some dummy user data with personality
INSERT INTO Users (Username, ProfilePicture) VALUES
    ('Mario', 'https://upload.wikimedia.org/wikipedia/fi/b/b2/Mario_BS.jpg'),
    ('Sonic', 'https://upload.wikimedia.org/wikipedia/fi/4/44/Modern_%26_Classic_Sonic.jpg'),
    ('Yoshi', 'https://upload.wikimedia.org/wikipedia/fi/6/6f/442px-Yoshiwalk.jpg'),
    ('Prinsessa Peach', 'https://upload.wikimedia.org/wikipedia/en/1/16/Princess_Peach_Stock_Art.png'),
    ('Toad', 'https://upload.wikimedia.org/wikipedia/en/d/d1/Toad_3D_Land.png');