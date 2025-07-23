# Blog Manager – Custom Drupal Blog Module

**Blog Manager** is a fully functional Drupal custom module that extends the default blog features provided by Drupal 9 and 10 core. While Drupal core includes a basic Blog content type, this module provides enhanced functionality tailored for real-world editorial workflows.

## 🆚 How This Module Enhances the Core Blog

Drupal 9 and 10 include the "Blog" content type in the standard installation profile, but it is limited in scope. Blog Manager upgrades this by introducing:

- **Custom editorial workflow statuses**: Draft, Ready to Publish, Published, Rejected, Archived
- **Role-based editorial access and permissions**
- **Advanced content scheduling with publish-to dates**
- **File upload restrictions and rich text editing**
- **User management tools for site administrators**
- **Out-of-the-box Views integration for content listings**

## 🎯 Key Features

- Blog content type with:
  - Title
  - Banner Image (JPG, PNG, GIF under 5MB)
  - Rich Text Content
  - Post Status (selectable: Draft, Ready to Publish, Published, Rejected, Archived)

- **User Roles**:
  - **Admin**:
    - Approve / Reject / Archive blog posts
    - Set Publish To Date
    - Manage editor accounts (create or suspend)
    - View all blog posts from all users
  - **Editor**:
    - Create, edit, and preview blog posts
    - Mark posts as "Ready to Publish"
    - View only their own blog posts

- **Views**:
  - All blog posts (admin)
  - Blog posts by author (editor)
  - Blog editor user listing

- **Custom Forms**:
  - Create Editor Account
  - Suspend or Reactivate Editor Accounts

- **Configuration-based Installation**:
  - Automatically sets up:
    - Content type with fields
    - Views
    - User roles and permissions

## ✅ Installation Instructions

1. Place the `blog_manager` module in the `modules/custom/` directory of your Drupal project.

2. Enable the module via the UI or using Drush:
   ```bash
   drush en blog_manager

## 📸 Screenshots

### 1. Editor Login – Dashboard
When a user with the **Editor** role logs in, they see a simplified dashboard with access to manage their own blog posts.

![Editor Login](screenshots/blog-1-login-as-blog-editor.png)

---

### 2. Editor – Create Blog Post Form  
Editors can create new blog posts using a structured form with a title, banner image, rich text content, and post status.

![Editor Create Blog](screenshots/blog-2-editor-login-blog-add-form.png)

---

### 3. Editor – My Blog Posts Table  
Editors can view, edit, and track the status of their own blog posts in a personal list view.

![Editor Posts Table](screenshots/blog-3-bloguser-table.png)

---

### 4. Admin – Blog Editors Table  
Admins can manage blog editors by activating, suspending, or modifying their status through a custom interface.

![Admin Users](screenshots/blog-4-admin-user-table.png)

---

### 5. Admin – All Blog Posts  
Admins see a table of all posts submitted by editors and can approve, reject, or archive them.

![Admin Blog Posts](screenshots/blog-5-admin-blog-posts-table.png)

---

### 6. Admin – Role and Permission Setup  
On installation, the module creates and configures roles for **Editor** and **Admin**, assigning appropriate permissions.

![Permissions](screenshots/blog-6-users-admin.png)

   
