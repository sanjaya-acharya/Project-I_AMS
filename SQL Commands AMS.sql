DROP DATABASE ProjectAMS;

CREATE DATABASE IF NOT EXISTS ProjectAMS;

USE ProjectAMS;

CREATE TABLE  IF NOT EXISTS Teachers(
    Name VARCHAR(50) NOT NULL,
    teacherID VARCHAR(10) NOT NULL PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE  IF NOT EXISTS CourseImages(
    imageID VARCHAR(10) NOT NULL PRIMARY KEY,
    image MEDIUMBLOB
);

CREATE TABLE  IF NOT EXISTS Courses(
    courseName VARCHAR(50) NOT NULL,
    courseID VARCHAR(10) NOT NULL PRIMARY KEY,
    teacherID VARCHAR(10) NOT NULL,
    FOREIGN KEY (teacherID) REFERENCES Teachers(teacherID),
    courseImageID VARCHAR(10) NOT NULL,
    FOREIGN KEY (courseImageID) REFERENCES CourseImages(imageID)
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

INSERT INTO Teachers Values ("TID001", "Sanjaya Acharya", "sanjayaacharya22780@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Teachers Values ("TID002", "Sanjay Pahari", "paharisanzay@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Teachers Values ("TID003", "Nishanta Paudel", "paudelnishanta@gmail.com", "5d41402abc4b2a76b9719d911017c592");

-- INSERT INTO Courses(ID,IMAGE) VALUES(1,);

-- INSERT INTO Courses Values ("CID001", "Maths", "TID001", LOAD_FILE('E:/Images/jack.jpg'));

INSERT INTO Courses Values ("CID001", "Maths", "TID001", "Img001");
INSERT INTO Courses Values ("CID002", "Physics", "TID001", "Img002");
INSERT INTO Courses Values ("CID003", "English", "TID002", "Img003");
INSERT INTO Courses Values ("CID004", "Social Studies", "TID002", "Img004");
INSERT INTO Courses Values ("CID005", "Computer Science", "TID003", "Img005");

INSERT INTO CourseImages Values ("Img001", LOAD_FILE('C:\xampp\htdocs\AMS\profile-icon.png'));



INSERT INTO Students Values ("SID001", "Dipesh Gautam", "dg001@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values ("SID002", "Ajit Baniya", "ab02@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values ("SID003", "Bibek Bhattrai", "bb03@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values ("SID004", "Sumin Gurung", "sg04@gmail.com", "5d41402abc4b2a76b9719d911017c592");

SELECT * FROM Teachers;
SELECT * FROM Courses;
SELECT * FROM Assignments;
SELECT * FROM Students;
SELECT * FROM Enrolments;
SELECT * FROM Marks;
