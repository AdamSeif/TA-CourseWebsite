# Teaching Assistant Management System

This project comprises a web-based Teaching Assistant (TA) management system aimed at facilitating the administration of TAs within an academic institution. The system allows administrators to perform various tasks such as adding, deleting, and modifying TA records, as well as assigning TAs to course offerings.

## Features

- **Main Menu:** Provides a central hub for accessing different functionalities of the system, including viewing all TAs, adding a new TA, deleting a TA, updating a TA's picture, assigning a TA to a course, checking course offerings, and looking up specific TAs.

- **Assign TA to Course Offering:** Enables the assignment of TAs to specific course offerings and provides the flexibility to specify the number of hours for each assignment.

- **Delete TA:** Allows administrators to delete a TA from the system by providing the TA's user ID.

- **TA Information:** Displays detailed information about a selected TA, including their user ID, first name, last name, student number, degree type, and optionally, an image.

- **Insert TA Information:** Provides a form for adding new TA records to the system, including fields for user ID, first name, last name, student number, degree type, and an optional image link.

- **View Course Offering:** Displays information about course offerings, including the course offering ID, number of students, term, and year. Administrators can select a specific course to view its offerings within a specified range of years.

## Database Schema

The project utilizes a MySQL database to store TA, course, and course offering data. The schema includes tables for TAs, courses, course offerings, as well as junction tables for recording TA-course relationships.

## Setup and Installation

To set up the project locally, follow these steps:

1. Clone the repository to your local machine.
2. Ensure you have a compatible web server environment set up, such as Apache with PHP and MySQL support.
3. Import the provided SQL script to set up the necessary database schema and sample data.
4. Configure the database connection settings in the PHP files to match your local environment.
5. Run the project on your web server.

## Technologies Used

- HTML
- CSS
- PHP
- MySQL

## Contributors

- [Your Name] - [Your Role/Contribution]
- [Contributor 1 Name] - [Contribution Description]
- [Contributor 2 Name] - [Contribution Description]

## License

This project is licensed under the [License Name] License - see the [LICENSE](LICENSE) file for details.
