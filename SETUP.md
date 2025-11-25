# Blog Site - Setup Instructions

## Quick Setup

### 1. Database Setup
- Open phpMyAdmin (http://localhost/phpmyadmin)
- Click "Import" tab
- Select `database_setup.sql` file
- Click "Go" to import

This will create:
- Database: `blog_site`
- Tables: `users`, `posts`
- Default admin user

### 2. Admin Login Credentials
- **Username:** admin
- **Password:** password

### 3. Access URLs

**Public Blog:**
- http://localhost/blog-site/public/
- http://localhost/blog-site/public/blog

**Admin Panel:**
- http://localhost/blog-site/public/admin/login

**JSON API:**
- http://localhost/blog-site/public/api/posts

## Features

### Admin Dashboard
- Login/logout functionality
- Create, edit, delete blog posts
- Draft/published status
- Fetch random dog images from dog.ceo API
- Post management interface

### Public Blog
- View all published posts
- Read individual posts
- Responsive design with Bootstrap
- Dog images integration

### API Endpoint
- GET `/api/posts` - Returns all published posts as JSON

## Usage

1. Login to admin panel with credentials above
2. Click "New Post" to create a blog post
3. Fill in title and content
4. Click "Get Random Dog" to fetch a dog image
5. Select status (draft/published)
6. Save the post
7. View your blog at the public URL
8. Test the API endpoint to get JSON data

## Dog API Integration
The system integrates with https://dog.ceo/api/breeds/image/random to fetch random dog images for blog posts.
