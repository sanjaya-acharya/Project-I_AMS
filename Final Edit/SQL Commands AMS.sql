DROP DATABASE ProjectAMS;

CREATE DATABASE IF NOT EXISTS ProjectAMS;

USE ProjectAMS;

CREATE TABLE  IF NOT EXISTS Teachers(
	teacherID INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	teacherName VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL
);

INSERT INTO Teachers Values (38523, "Sanjaya Acharya", "sanjayaacharya22780@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Teachers Values (92418, "Sanjay Pahari", "paharisanzay@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Teachers Values (91853, "Nishanta Paudel", "paudelnishanta@gmail.com", "5d41402abc4b2a76b9719d911017c592");

CREATE TABLE  IF NOT EXISTS CourseImages(
	imageID INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	imageURL VARCHAR(50) NOT NULL
);

INSERT INTO courseImages VALUES (99006, "Geometry.jpg");
INSERT INTO courseImages VALUES (87043, "Psychology.jpg");
INSERT INTO courseImages VALUES (30642, "Math.jpg");
INSERT INTO courseImages VALUES (71231, "Chemistry.jpg");
INSERT INTO courseImages VALUES (74722, "Physics.jpg");
INSERT INTO courseImages VALUES (61175, "Biology.jpg");
INSERT INTO courseImages VALUES (98329, "WorldStudies.jpg");
INSERT INTO courseImages VALUES (89566, "English.jpg");
INSERT INTO courseImages VALUES (65317, "WorldHistory.jpg");
INSERT INTO courseImages VALUES (43074, "SocialStudies.jpg");
INSERT INTO courseImages VALUES (42202, "Geography.jpg");
INSERT INTO courseImages VALUES (81310, "Writing.jpg");
INSERT INTO courseImages VALUES (20094, "USHistory.jpg");
INSERT INTO courseImages VALUES (54400, "LanguageArts.jpg");
INSERT INTO courseImages VALUES (39118, "Honors.jpg");
INSERT INTO courseImages VALUES (57306, "Breakfast.jpg");
INSERT INTO courseImages VALUES (56545, "Graduation.jpg");
INSERT INTO courseImages VALUES (49382, "BookClub.jpg");
INSERT INTO courseImages VALUES (60846, "Reachout.jpg");
INSERT INTO courseImages VALUES (91193, "LearnLanguage.jpg");
INSERT INTO courseImages VALUES (50747, "BackToSchool.jpg");
INSERT INTO courseImages VALUES (58596, "Read.jpg");
INSERT INTO courseImages VALUES (50142, "Code.jpg");

CREATE TABLE  IF NOT EXISTS Courses(
	courseID INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	courseName VARCHAR(50) NOT NULL,

	teacherID INT(5) NOT NULL,
	FOREIGN KEY (teacherID) REFERENCES Teachers(teacherID),
	imageID INT(5) NOT NULL,
	FOREIGN KEY (imageID) REFERENCES CourseImages(imageID)
);

INSERT INTO Courses Values (42418, "Maths", 38523, 30642);
INSERT INTO Courses Values (31304, "Physics", 91853, 74722);
INSERT INTO Courses Values (73626, "English", 91853, 89566);
INSERT INTO Courses Values (52216, "Social Studies", 91853, 43074);
INSERT INTO Courses Values (59231, "Computer Science", 38523, 50142);
INSERT INTO Courses Values (48600, "History", 92418, 20094);
INSERT INTO Courses Values (77808, "Geography", 92418, 42202);

CREATE TABLE  IF NOT EXISTS Assignments(
	assignmentID INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	assignmentName VARCHAR(50) NOT NULL,
	assignedDate DATE NOT NULL,
	dueDate DATE NOT NULL,
	questionURL VARCHAR(50) NOT NULL,

	courseID INT(5) NOT NULL,
	FOREIGN KEY (courseID) REFERENCES Courses(courseID)
);

INSERT INTO Assignments Values (46679, "M A 1", "2022-11-01", "2022-11-10", "maths-assignment1.jpg", 42418);
INSERT INTO Assignments Values (11255, "M A 2", "2022-11-05", "2022-11-15", "maths-assignment2.jpg", 42418);
INSERT INTO Assignments Values (78418, "C A 1", "2022-11-03", "2022-11-13", "computer-assignment1.jpg", 59231);
INSERT INTO Assignments Values (55265, "C A 2", "2022-11-08", "2022-11-18", "computer-assignment1.jpg", 59231);

CREATE TABLE  IF NOT EXISTS Students(
	studentID INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	studentName VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL
);

INSERT INTO Students Values (93893, "Dipesh Gautam", "dg001@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (63937, "Ajit Baniya", "ab02@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (53780, "Bibek Bhattrai", "bb03@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (34695, "Sumin Gurung", "sg04@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (86680, "Clark Miranda", "cm07@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (50485, "Mariana Hart", "mh08@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (56889, "Darwin Foster", "df09@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (28025, "Brennen Bond", "bb10@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (15789, "Wilson Maxwell", "wm11@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (29085, "Cody Henderson", "ch12@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (73515, "Hillary Galloway", "hg13@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (11514, "Reyna Rivers", "rr14@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (36386, "Trenton Marks", "tm15@gmail.com", "5d41402abc4b2a76b9719d911017c592");
INSERT INTO Students Values (98689, "Ayla Krause", "ak16@gmail.com", "5d41402abc4b2a76b9719d911017c592");

CREATE TABLE  IF NOT EXISTS Enrolments (
	studentID INT(5) NOT NULL,
	FOREIGN KEY (studentID) REFERENCES Students(studentID),
	courseID INT(5) NOT NULL,
	FOREIGN KEY (courseID) REFERENCES Courses(courseID)
);

INSERT INTO Enrolments Values (93893, 42418);
INSERT INTO Enrolments Values (93893, 59231);
INSERT INTO Enrolments Values (93893, 31304);
INSERT INTO Enrolments Values (63937, 42418);
INSERT INTO Enrolments Values (63937, 59231);
INSERT INTO Enrolments Values (63937, 31304);
INSERT INTO Enrolments Values (53780, 42418);
INSERT INTO Enrolments Values (53780, 59231);
INSERT INTO Enrolments Values (53780, 31304);
INSERT INTO Enrolments Values (34695, 42418);
INSERT INTO Enrolments Values (34695, 59231);
INSERT INTO Enrolments Values (34695, 31304);

CREATE TABLE  IF NOT EXISTS Works (
	workID INT(5) NOT NULL PRIMARY KEY,
	workFileURL VARCHAR(50) NOT NULL,
	submittedDate DATE NOT NULL,
	checkedStatus INT(1) NOT NULL,

	studentID INT(5) NOT NULL,
	FOREIGN KEY (studentID) REFERENCES Students(studentID),
	assignmentID INT(5) NOT NULL,
	FOREIGN KEY (assignmentID) REFERENCES Assignments(assignmentID)
);

INSERT INTO Works Values (64704, "Answers.pdf", "2022-11-09", 0, 93893, 46679);
INSERT INTO Works Values (91249, "Answers.pdf", "2022-11-10", 0, 93893, 11255);
INSERT INTO Works Values (91361, "Answers.pdf", "2022-11-10", 0, 93893, 78418);
INSERT INTO Works Values (69015, "Answers.pdf", "2022-11-10", 0, 93893, 55265);
INSERT INTO Works Values (84427, "Answers.pdf", "2022-11-11", 0, 86680, 46679);
INSERT INTO Works Values (34464, "Answers.pdf", "2022-11-08", 0, 50485, 11255);
INSERT INTO Works Values (85461, "Answers.pdf", "2022-11-10", 0, 56889, 78418);
INSERT INTO Works Values (26658, "Answers.pdf", "2022-11-09", 0, 28025, 55265);
INSERT INTO Works Values (84196, "Answers.pdf", "2022-11-09", 0, 15789, 46679);
INSERT INTO Works Values (76976, "Answers.pdf", "2022-11-09", 0, 29085, 11255);
INSERT INTO Works Values (25639, "Answers.pdf", "2022-11-09", 0, 73515, 78418);
INSERT INTO Works Values (44705, "Answers.pdf", "2022-11-09", 0, 11514, 46679);
INSERT INTO Works Values (55478, "Answers.pdf", "2022-11-09", 0, 36386, 11255);
INSERT INTO Works Values (64831, "Answers.pdf", "2022-11-09", 0, 98689, 78418);

CREATE TABLE  IF NOT EXISTS Reviews (
	message VARCHAR(255),

	studentID INT(5) NOT NULL,
	FOREIGN KEY (studentID) REFERENCES Students(studentID),
	assignmentID INT(5) NOT NULL,
	FOREIGN KEY (assignmentID) REFERENCES Assignments(assignmentID),
	UNIQUE (assignmentID, studentID)
);

INSERT INTO Reviews Values ("Answers are incorrect", 93893, 46679);
INSERT INTO Reviews Values ("Answers are incorrect", 93893, 11255);
INSERT INTO Reviews Values ("Resubmit this assignment", 86680, 46679);
INSERT INTO Reviews Values ("Answers are incorrect", 50485, 11255);
INSERT INTO Reviews Values ("Answers are incorrect", 15789, 46679);
INSERT INTO Reviews Values ("Resubmit this assignment", 11514, 46679);

CREATE TABLE  IF NOT EXISTS Marks (
	Marks INT(3) NOT NULL,

	workID INT(5) NOT NULL,
	UNIQUE (workID),
	FOREIGN KEY (workID) REFERENCES Works(workID)
);

INSERT INTO Marks Values (10, 91361);
INSERT INTO Marks Values (10, 69015);
INSERT INTO Marks Values (10, 85461);
INSERT INTO Marks Values (10, 26658);
INSERT INTO Marks Values (10, 76976);
INSERT INTO Marks Values (10, 25639);
INSERT INTO Marks Values (10, 55478);
INSERT INTO Marks Values (10, 64831);

CREATE TABLE IF NOT EXISTS Notifications (
	notificationID INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	message VARCHAR(255) NOT NULL,
	ownerID INT(5) NOT NULL,
	sentDate DATE NOT NULL,
	sentTime TIME NOT NULL
);

INSERT INTO Notifications (message, ownerID, sentDate, sentTime) Values ("Welcome!", 38523, "2022-11-09", "12:30");
INSERT INTO Notifications (message, ownerID, sentDate, sentTime) Values ("New assignment Submitted!", 38523, "2022-11-09", "12:30");
INSERT INTO Notifications (message, ownerID, sentDate, sentTime) Values ("Password Changed!", 38523, "2022-11-09", "12:30");
