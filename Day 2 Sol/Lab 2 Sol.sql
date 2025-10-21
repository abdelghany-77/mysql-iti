CREATE TABLE STUDENT (
    StudentID INT PRIMARY KEY auto_increment,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) UNIQUE,
    Address VARCHAR(255)
);

CREATE TABLE PHONE (
    PhoneID INT PRIMARY KEY,
    StudentID INT NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES STUDENT(StudentID)
);

CREATE TABLE SUBJECT (
    SubjectID INT PRIMARY KEY auto_increment,
    SubjectName VARCHAR(50) UNIQUE NOT NULL,
    Description VARCHAR(255),
    MaxScore INT NOT NULL
);

CREATE TABLE ENROLLMENT (
    EnrollmentID INT PRIMARY KEY auto_increment,
    StudentID INT NOT NULL,
    SubjectID INT NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES STUDENT(StudentID),
    FOREIGN KEY (SubjectID) REFERENCES SUBJECT(SubjectID)
);

CREATE TABLE EXAM (
    ExamID INT PRIMARY KEY auto_increment,
    EnrollmentID INT NOT NULL,
    ExamDate DATE NOT NULL,
    Score DECIMAL(5, 2) NOT NULL,
    FOREIGN KEY (EnrollmentID) REFERENCES ENROLLMENT(EnrollmentID)
);

INSERT INTO SUBJECT (SubjectID, SubjectName, Description, MaxScore) VALUES
(default, 'C Programming', 'Introduction to procedural programming.', 100),
(default, 'C++ (CPP)', 'Object-Oriented Programming concepts.', 100),
(default, 'HTML5', 'Structure and content of web pages.', 50),
(default, 'JavaScript (JS)', 'Client-side web scripting language.', 75),
(default, 'Database Systems', 'SQL and relational database theory.', 100);


INSERT INTO STUDENT (StudentID, Name, Email, Address) VALUES
(default, 'Ahmed Adel', 'ahmed.a@iti.eg', '10th St, Nasr City'),
(default, 'Sara Mostafa', 'sara.m@iti.eg', '15th Road, Maadi'),
(default, 'Tarek Khalil', 'tarek.k@iti.eg', 'Villa 5, New Cairo'),
(default, 'Laila Hassan', 'laila.h@iti.eg', 'Apt 22, Dokki'),
(default, 'Omar Galal', 'omar.g@iti.eg', '5th Settlement, Cairo');

INSERT INTO PHONE (PhoneID, StudentID, PhoneNumber) VALUES
(1001, 1, '010-1234-5678'),
(1002, 2, '011-9876-5432'),
(1003, 3, '012-1122-3344'),
(1004, 1, '015-0011-2233'),
(1005, 5, '010-5555-6666');

INSERT INTO ENROLLMENT (EnrollmentID, StudentID, SubjectID) VALUES
(default, 1, 1),
(default, 1, 2),
(default, 2, 3),
(default, 2, 4),
(default, 3, 5);

INSERT INTO EXAM (ExamID, EnrollmentID, ExamDate, Score) VALUES
(default, 1, '2025-10-15', 85.50),
(default, 2, '2025-10-16', 78.00),
(default, 3, '2025-10-17', 45.00),
(default, 5, '2025-10-18', 60.25),
(default, 1, '2025-11-20', 92.00);


ALTER TABLE STUDENT
ADD COLUMN Gender ENUM('Male', 'Female') DEFAULT 'Male' ;

ALTER TABLE STUDENT
ADD COLUMN BirthDate DATE;

ALTER TABLE STUDENT
DROP COLUMN Name,
ADD COLUMN FirstName VARCHAR(50) NOT NULL,
ADD COLUMN LastName VARCHAR(50) NOT NULL;

ALTER TABLE STUDENT
DROP COLUMN Email,
DROP COLUMN Address,
ADD COLUMN ContactInfo JSON;


# ALTER TABLE PHONE
#     DROP FOREIGN KEY phone_ibfk_1;
#
# ALTER TABLE PHONE
# ADD CONSTRAINT fk_phone_student
#     FOREIGN KEY (StudentID)
#     REFERENCES STUDENT(StudentID)
#     ON DELETE CASCADE;
#
# ALTER TABLE ENROLLMENT
#     DROP FOREIGN KEY enrollment_ibfk_1,
#     DROP FOREIGN KEY enrollment_ibfk_2;
#
# ALTER TABLE ENROLLMENT
# ADD CONSTRAINT fk_enrollment_student
#     FOREIGN KEY (StudentID)
#     REFERENCES STUDENT(StudentID)
#     ON DELETE CASCADE,
# ADD CONSTRAINT fk_enrollment_subject
#     FOREIGN KEY (SubjectID)
#     REFERENCES SUBJECT(SubjectID)
#     ON DELETE CASCADE;
#
# ALTER TABLE EXAM
#     DROP FOREIGN KEY exam_ibfk_1;
#
# ALTER TABLE EXAM
# ADD CONSTRAINT fk_exam_enrollment
#     FOREIGN KEY (EnrollmentID)
#     REFERENCES ENROLLMENT(EnrollmentID)
#     ON DELETE CASCADE;



SELECT * FROM STUDENT;


UPDATE STUDENT
SET
    FirstName = 'Ahmed',
    LastName = 'Adel',
    Gender = 'Male',
    BirthDate = '1990-05-15',
    ContactInfo = '{"email": "ahmed.a@iti.eg", "address": "10th St, Nasr City"}'
WHERE StudentID = 1;

UPDATE STUDENT
SET
    FirstName = 'Sara',
    LastName = 'Mostafa',
    Gender = 'Female',
    BirthDate = '1995-11-22',
    ContactInfo = '{"email": "sara.m@iti.eg", "address": "15th Road, Maadi"}'
WHERE StudentID = 2;

UPDATE STUDENT
SET
    FirstName = 'Tarek',
    LastName = 'Khalil',
    Gender = 'Male',
    BirthDate = '1991-03-01',
    ContactInfo = '{"email": "tarek.k@iti.eg", "address": "Villa 5, New Cairo"}'
WHERE StudentID = 3;

UPDATE STUDENT
SET
    FirstName = 'Laila',
    LastName = 'Hassan',
    Gender = 'Female',
    BirthDate = '1994-07-10',
    ContactInfo = '{"email": "laila.h@iti.eg", "address": "Apt 22, Dokki"}'
WHERE StudentID = 4;

UPDATE STUDENT
SET
    FirstName = 'Omar',
    LastName = 'Galal',
    Gender = 'Male',
    BirthDate = '1993-01-28',
    ContactInfo = '{"email": "omar.g@iti.eg", "address": "5th Settlement, Cairo"}'
WHERE StudentID = 5;

UPDATE STUDENT
SET
    FirstName = 'Mohammed',
    LastName = 'Saleh',
    Gender = 'Male',
    BirthDate = '1996-08-05',
    ContactInfo = '{"email": "mohammed.s@iti.eg", "address": "Giza"}'
WHERE StudentID = 6;

UPDATE STUDENT
SET
    FirstName = 'Mohammed',
    LastName = 'Zaki',
    Gender = 'Male',
    BirthDate = '1996-09-01',
    ContactInfo = '{"email": "mohammed.z@iti.eg", "address": "Heliopolis"}'
WHERE StudentID = 7;

UPDATE STUDENT
SET
    FirstName = 'Sara',
    LastName = 'Ali',
    Gender = 'Female',
    BirthDate = '1995-12-01',
    ContactInfo = '{"email": "sara.a@iti.eg", "address": "Alexandria"}'
WHERE StudentID = 8;

UPDATE STUDENT
SET
    FirstName = 'Mohammed',
    LastName = 'Ahmed',
    Gender = 'Male',
    BirthDate = '1997-01-01',
    ContactInfo = '{"email": "mohammed.a@iti.eg", "address": "Mokattam"}'
WHERE StudentID = 9;


SELECT *
FROM STUDENT
WHERE Gender = 'Male';

SELECT COUNT(*) AS FemaleCount
FROM STUDENT
WHERE Gender = 'Female';

SELECT *
FROM STUDENT
WHERE BirthDate < '1992-10-01';

SELECT *
FROM STUDENT
WHERE Gender = 'Male'
  AND BirthDate < '1991-03-01';

SELECT *
FROM SUBJECT
ORDER BY MaxScore DESC;

SELECT *
FROM SUBJECT
ORDER BY MaxScore DESC
LIMIT 1;

SELECT FirstName
FROM STUDENT
WHERE FirstName LIKE 'A%';

SELECT COUNT(*) AS MohammedCount
FROM STUDENT
WHERE FirstName = 'Mohammed';


SELECT Gender, COUNT(*) AS Count
FROM STUDENT
GROUP BY Gender;

SELECT FirstName, COUNT(*) AS NameCount
FROM STUDENT
GROUP BY FirstName
HAVING COUNT(*) > 2;


SELECT
    S.FirstName,
    S.LastName,
    SUB.SubjectName,
    E.Score
FROM STUDENT S
JOIN ENROLLMENT EN ON S.StudentID = EN.StudentID
JOIN SUBJECT SUB ON EN.SubjectID = SUB.SubjectID
JOIN EXAM E ON EN.EnrollmentID = E.EnrollmentID
ORDER BY S.LastName, SUB.SubjectName;

DELETE FROM STUDENT
WHERE StudentID IN (
    SELECT DISTINCT EN.StudentID
    FROM EXAM E
    JOIN ENROLLMENT EN ON E.EnrollmentID = EN.EnrollmentID
    WHERE E.Score < 50
);

