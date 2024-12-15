-- Drop the `books` table if it exists
DROP TABLE IF EXISTS books;


-- Create the `books` table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL
);

-- Insert sample data into the `books` table
INSERT INTO books (title, author) VALUES
('To Kill a Mockingbird', 'Harper Lee'),
('1984', 'George Orwell'),
('The Great Gatsby', 'F. Scott Fitzgerald'),
('Moby Dick', 'Herman Melville'),
('Pride and Prejudice', 'Jane Austen'),
('The Catcher in the Rye', 'J.D. Salinger'),
('Brave New World', 'Aldous Huxley'),
('Fahrenheit 451', 'Ray Bradbury'),
('The Hobbit', 'J.R.R. Tolkien'),
('War and Peace', 'Leo Tolstoy'),
('The Odyssey', 'Homer'),
('Crime and Punishment', 'Fyodor Dostoevsky'),
('Jane Eyre', 'Charlotte Bronte'),
('Wuthering Heights', 'Emily Bronte'),
('Anna Karenina', 'Leo Tolstoy'),
('The Grapes of Wrath', 'John Steinbeck'),
('Frankenstein', 'Mary Shelley'),
('Dracula', 'Bram Stoker'),
('The Lord of the Rings', 'J.R.R. Tolkien'),
('The Brothers Karamazov', 'Fyodor Dostoevsky');
