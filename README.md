# Puzzle Event Management System

## Project Overview

This is a web application designed for managing puzzle events and competitions. It helps organizers create and manage puzzle challenges where teams compete to solve puzzles and reach the final challenge.

Key Features:
- Organizers can create and manage puzzle challenges
- Teams can participate in the event from the website
- System tracks team progress through different puzzles
- Organizers can verify team answers
- Teams can submit their solutions
- Progress tracking for all teams
- Secure answer verification system

The application makes it easy for:
- Event organizers to manage the entire puzzle competition
- Teams to participate and track their progress
- Everyone to have a fun and engaging puzzle-solving experience

## What You Need to Run This Project

1. PHP (version 7.4 or higher)
2. MySQL Database
3. Composer (PHP package manager)
4. Web server (like Apache or XAMPP)

## How to Set Up

1. Copy the `.env` file to your `.env` and fill in your database details:
   ```
   DB_HOST=localhost
   DB_NAME=your_database_name
   DB_USER=your_username
   DB_PASS=your_password
   DB_CHARSET=utf8mb4
   ```

2. Install the required packages:
   ```
   composer install vlucas/phpdotenv
   ```

3. Make sure your web server is running

4. Open the project in your web browser


## Security Notes

- Never share your `.env` file
- Keep your database password safe
- Make sure your web server is properly configured

## Need Help?

If you have any questions or need help, please contact the project administrator.
