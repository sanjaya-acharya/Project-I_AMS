# Assignment Management System (Minor Project - I)
## Objective
To make a web application for managing student's assignment.

## Main functionality
### For student
- Submit assignment
- View submitted assignments.
- Unsubmit submitted assignments.

### For teacher
- Add assignments.
- Review submitted assignments.
- Edit assignments.
- Delete assignments.

<br />

# Entities
| Teacher |
| :- |
| Name |
| Email |
| TeacherID |
| Password |

<br />
<br />

| Student |
| :- |
| Name |
| Email |
| StudentID |
| Password |
| Points |

<br />
<br />

| Course |
| :- |
| courseName |
| CourseID |
| TeacherID |


<br />
<br />

| Enrolments |
| :- |
| CourseID |
| StudentID |


<br />
<br />

| Assignment |
| :- |
| assignmentName |
| AssignmentID |
| CourseID |
| assignedDate |
| dueDate |
| fullMarks |
| questionsPhoto |

<br />
<br />

| Marks |
| :- |
| AssignmentID |
| StudentID |
| Points |

<br />
<br />

| Response |
| :- |
| TeacherID |
| StudentID |
| AssignmentID |
| Message |

<br />
<br />

| Work |
| :- |
| StudentID |
| AssignmentID |
| answersFile |

<br />
<br />

## Main methods
addAssignemt(AssignmentID, CourseID, assignmentName, assignedDate, dueDate, fullMarks, questionsPhoto)
- AssignementID, assignedDate is auto generated

<br/>

viewAssignment(AssignmentID)
- Downloading assignment

<br/>

postReview(AssignmentID, StudentID, message)

<br/>

editAssignment(AssignementID, newQuestionsPhoto)

<br/>

deleteAssignment(AssignmentId)
- Confirmation needed

<br/>

submitAssignemt(StudentID, AssignementID, answersFile)

<br/>

unsubmitAssignment(AssignmentID)

<br/>

viewMarks(StudentID)

<br/>

### Tasks
Front-end - Sanjay Pahari and Nishanta Paudel <br/>
Database  - Nishanta Paudel <br/>
Back-end  - Sanjaya Acharya
