
## For Role Base Setup
I have used Spatie laravel package for role based login

# for Auth
I have used Breez package for login super admin.
For admin and member i have created custom login form. 

# Code Structure
I have used Service Classes to keep all business logic separate from controllers. This makes the code reusable, as we can call the same service methods from different controllers whenever needed.

For validation, I have created separate Form Request classes to keep validation logic separate and controllers clean and easy to maintain.

I have used Middleware to manage role-based access and redirect users to their respective dashboards based on their assigned roles after login.

# invitation
I have used an SMTP service to send invitation emails. I have configured SMTP using my email account (sandyjamwal292@gmail.com). I have shared the SMTP credentials via email. Please check your inbox and update the `.env` file with the provided credentials.

# Seeder
run seeder comaand---->php artisan db:seed for enter super admin registartion and role seeder.

# How it works
Super admin login, on his dashboard he can check lists of company admin users, with status of invitation accpet or pending.
Also super admin can check all genrated URLs.

# Admin
Admin receives an invitation email. Registers by entering the company name and password. After successful registration, Admin is  redirected to the login page. After login, Admin can invite other Admins and Members. Admin can generate short URLs.

# Members
Members receive an invitation email. Accept the invitation by setting a password. After registration, they become members of the respective company. Members can view only their own generated short URLs.

