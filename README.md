# VoidWorks-ShipYard

# Acmegegrade July Internship Ecommerce Project

## Project Website
- [VoidWorks ShipYard](https://vwsy.free.nf)




## Table of Contents
- [Admin Panel](#admin-panel)
- [User Panel](#user-panel)
- [Login Details](#dummy-login-details)
- [Database Setup](#database-setup)
- [Project Technologies](#project-technologies)
- [Developer Contact](#developer-contact)

---

## Admin Panel

   ### Separate Login Portal
   Access the admin panel at: `domainname/Admin`
   
   ### Features
   - Edit User Info
   - Delete Users
   - Purge Unused Product Images from the Server to Save Space
   
   ### Links
   - phpMyAdmin Panel
   - CPanel
   - Hosting Provider Control Panel

---

## User Panel

### Account Types
1. **Client**
   - Standard Menu, Header, Footer with username displayed on the top right corner on all pages
   - Home Page with Carousel, Branding, and About
   - Products Page (can specify quantity to Add to Cart)
   - Cart Page with Sticky Checkout Bar at the bottom (calculates the total price based on quantity and item price, hides the Place Order Button if the total price is 0)
   - Thank You Page after an order is placed
   - Orders Page: View order status, past order details, cancel orders (cancel order not possible if order status is DELIVERED)
   - Product Search function using the Search bar (accepts multiple search inputs: product names, PID, description, vendor name)
   - Logout button on the menu: Session destroyed when clicked, and can't access the client page without logging in again.

2. **Vendor**
   - Standard Menu, Header, Footer with username displayed on the top right corner on all pages
   - Home Page with Vendor's Products; vendor can choose to delete products or go to edit products page from here.
   - Add Products page: Accepts special characters like ' or " as input, automatically inputs commas on price insert (Downside: things start breaking down if anything other than integers is entered). On image file upload, it renames the file with a unique filename so that it doesn't conflict with other images if an image with the same name is uploaded.
   - Edit Products page: Same features as the Add Products page, but on image file upload, it changes the name of the new file to the old one and replaces the old file. The site automatically reloads the changed image to the browser cache to reflect the change.
   - Orders Page: Orders can be fulfilled here; the vendor can deliver products, view details of their client, and the total amount of the order price. Orders cannot be DELIVERED if the client chooses to cancel the order before the vendor delivers.

### Login
Users are sent to the appropriate user panel based on the selected account type (Client/Vendor).

### Sign-Up
Standard Sign-up Panel (can use special characters like ' or " for username).

### Reset Password
Users can change their password using their Existing Password or Temp Password (provided by Support/Admin and can be set using the Admin Panel).

---

## Dummy Login Details

- **Admin:**
  - Username: Admin
  - Password: admin:123

- **Client:**
  - Username: Tox
  - Password: 123
  - Username: Mike
  - Password: 123

- **Vendor:**
  - Username: Rock
  - Password: 123
  - Username: Xel
  - Password: 123
  - Username: Kion
  - Password: 123

---

## Database Setup

1. Import the included SQL dump file (`acme23_jul.sql`) in your phpMyAdmin panel to copy the exact database structure and entries.
2. Change parameters in the `acme23_jul.sql` file to match your system to avoid import errors:
   - Host
   - Database
   - CHARSET
   - COLLATE

3. Change the Database login parameters in `./shared/connection.php` to match your system **(IMPORTANT)**.

---

## Project Technologies

This project is built using a variety of technologies, including:
- HTML5
- CSS
- JavaScript
- PHP
- Bootstrap 5
- Apache Server
- phpMyAdmin SQL server
- XAMPP Control Panel

---

## Developer Contact

For any questions or assistance, please contact the developer at ridhanta2001@gmail.com.

