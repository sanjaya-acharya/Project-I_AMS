CREATE DATABASE IF NOT EXISTS ProjectAMS;

USE ProjectAMS;

CREATE TABLE  IF NOT EXISTS Teachers(
    Name VARCHAR(50) NOT NULL,
    teacherID VARCHAR(10) NOT NULL PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE  IF NOT EXISTS Courses(
    courseName VARCHAR(50) NOT NULL,
    courseID VARCHAR(10) NOT NULL PRIMARY KEY,
    teacherID VARCHAR(10) NOT NULL,
    FOREIGN KEY (teacherID) REFERENCES Teachers(teacherID)
);

CREATE TABLE  IF NOT EXISTS Assignments(
    assignmentID VARCHAR(10) NOT NULL PRIMARY KEY,
    assignmentName VARCHAR(50),
    assignedDate DATE,
    dueDate DATE,
    questions MEDIUMBLOB,

    courseID VARCHAR(10) NOT NULL,
    FOREIGN KEY (courseID) REFERENCES Courses(courseID)
);

CREATE TABLE  IF NOT EXISTS Students(
    Name VARCHAR(50) NOT NULL,
    studentID VARCHAR(10) NOT NULL PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE  IF NOT EXISTS Enrolments (
    studentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES Students(studentID),
    courseID VARCHAR(10) NOT NULL,
    FOREIGN KEY (courseID) REFERENCES Courses(courseID)
);

CREATE TABLE  IF NOT EXISTS Marks (
    Marks FLOAT(2),
    studentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES Students(studentID),
    assignmentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (assignmentID) REFERENCES Assignments(assignmentID)
);

CREATE TABLE  IF NOT EXISTS Works (
    workFile MEDIUMBLOB,
    studentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES Students(studentID),
    assignmentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (assignmentID) REFERENCES Assignments(assignmentID)
);

CREATE TABLE  IF NOT EXISTS Responses (
    message VARCHAR(255),
    teacherID VARCHAR(10) NOT NULL,
    FOREIGN KEY (teacherID) REFERENCES Teachers(teacherID),
    studentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES Students(studentID),
    assignmentID VARCHAR(10) NOT NULL,
    FOREIGN KEY (assignmentID) REFERENCES Assignments(assignmentID)
);

CREATE TABLE  IF NOT EXISTS Notifications (
    notificationID VARCHAR(10) NOT NULL PRIMARY KEY,
    ownerID VARCHAR(10) NOT NULL,
    readStatus TINYINT(1)
);


-- desc Teachers;
-- desc Courses;
-- desc Assignments;
-- desc Students;
-- desc Enrolments;
-- desc Marks;

INSERT INTO Teachers Values (1, "Sanjaya Acharya", "sanjayaacharya22780@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Teachers Values (2, "Sanjay Pahari", "paharisanzay@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Teachers Values (3, "Nishanta Paudel", "paudelnishanta@gmail.com", "5d41402abc4b2a76b9719d911017c592");

INSERT INTO Courses Values (101, "Biology", 3);
INSERT INTO Courses Values (102, "Maths", 1);
INSERT INTO Courses Values (103, "Chemistry", 2);
INSERT INTO Courses Values (104, "Physics", 2);
INSERT INTO Courses Values (105, "C", 3);
INSERT INTO Courses Values (106, "C++", 1);

INSERT INTO Assignments Values (1001, "Assignment 1", 2022-12-01, 2022-12-07, 101);
INSERT INTO Assignments Values (1002, "Assignment 1", 2022-12-01, 2022-12-07, 102);
INSERT INTO Assignments Values (1003, "Assignment 2", 2022-12-01, 2022-12-07, 102);
INSERT INTO Assignments Values (1004, "Assignment 2", 2022-12-01, 2022-12-07, 101);
INSERT INTO Assignments Values (1005, "Assignment 3", 2022-12-01, 2022-12-07, 101);
INSERT INTO Assignments Values (1006, "Assignment 1", 2022-12-01, 2022-12-07, 103);
INSERT INTO Assignments Values (1007, "Assignment 4", 2022-12-01, 2022-12-07, 101);
INSERT INTO Assignments Values (1008, "Assignment 1", 2022-12-01, 2022-12-07, 105);
INSERT INTO Assignments Values (1009, "Assignment 1", 2022-12-01, 2022-12-07, 106);
INSERT INTO Assignments Values (1010, "Assignment 2", 2022-12-01, 2022-12-07, 106);
INSERT INTO Assignments Values (1011, "Assignment 2", 2022-12-01, 2022-12-07, 105);
INSERT INTO Assignments Values (1012, "Assignment 1", 2022-12-01, 2022-12-07, 104);

INSERT INTO Students Values (10001, "Student 001", "student01@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10002, "Student 002", "student02@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10003, "Student 003", "student03@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10004, "Student 004", "student04@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10005, "Student 005", "student05@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10006, "Student 006", "student06@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10007, "Student 007", "student07@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10008, "Student 008", "student08@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10009, "Student 009", "student09@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10010, "Student 010", "student10@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10011, "Student 011", "student11@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10012, "Student 012", "student12@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10013, "Student 013", "student13@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10014, "Student 014", "student14@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (10015, "Student 015", "student15@gmail.com", "5d41402abc4b2a76b9719d911017c592");


SELECT * FROM Teachers;
SELECT * FROM Courses;
SELECT * FROM Assignments;
SELECT * FROM Students;
SELECT * FROM Enrolments;
SELECT * FROM Marks;
