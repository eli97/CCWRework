# CrystalClearWebsite
![](/assets/img/CClogo2.svg)

## Synopsis: 

This is a website for Crystal Clear Pool Service, managed by sole proprietor Daniel Semeryuk. The website will advertise his business and provide convenient features 
for his clients. His clients will be able to create an account for the website, which will allow them to subscribe to his services online and pay automatically, as well 
as provide a convenient way to see payment and service history. New clients who find his business online are not obligated to create an account and can still choose to 
request an estimate in person and pay through traditional means like check or cash. 

## Contributor

Elijah Semeryuk<br />
Jonathon Kasten<br />
Colton Bearquiver<br />
Giselle Fuentes<br />
Jin Park<br />
Nue Khang<br />
Viktoria Penkova<br />
Kevin Houth<br />

## Testing:

1. Testing consists of ensuring that all web pages scale properly when zooming in/out and resizing the browser window. 
2. For data entry, simple SQL injection is tested which should be avoided by using prepared statements and grants. 
3. All mandatory fields should be validated and indicated.
4. Password complexity requirements should be reliably enforced.
5. Check each page for broken links and images.
6. Input fields should be checked for the max field value. Input values greater than the specified max limit should not be accepted or stored in the database.
7. Check all input fields for special characters.
8. The user should not be able to submit a page twice by pressing the submit button in quick succession.

Testing will be expanded upon as development continues:
1. Test Environment:
    * Testing branch in Github Repository
    * Test Database (test data)
    * Google Sheets/Excel (Test case management)
2. Testing:
    * Create test cases from user stories and jira subtasks
    * Test cases pass/fail according to Acceptance Criteria
    * Regression and new functionality
    * Manual and automated tests
3. Bugs/Defects:
    * Open a new jira for bug/defect
    * Include steps to recreate
    * Include documentation (test steps, descriptions, screenshots, etc.)
    
Testing System Requirements
   * Windows Operating System (Windows 10)
   * Google Chrome, Mozilla Firefox, Microsoft Edge
   * Selenium 4.4.3 or Newer
   * Python 3.10 or newer
   * ChromeDriver (Google Chrome version) -- for automation
   * PHPUnit Ver. 9

To run:
   * open terminal in vscode
   * cd ./Tests
   * python <test_file>.py

## Deployment:

Deployment of this website consists of reserving a hostname, choosing a hosting service, configuring DNS settings, and migrating all source code for deployment. Initial
deployment will consist of a work-in-progress live demo.

## Developer instructions: 

Our team has used VS Code git integration for revision control, which offers a GUI. We referred to the prototype and client meetings for development of pages and 
features.

1. Fork the repository 
2. Create your feature branch: git checkout -b new-feature
3. Commit your changes: git commit -am 'Added feature'
4. Push to the branch: git push origin new-feature
5. Submit a pull request

## User Manual:

How to run/deploy:

The website is hosted on Bluehost web service, so it is a matter of logging into the admin account on bluehost.<br />
You may view the site here: [CrystalClearPoolService](https://crystalclearwestsac.com/) <br />

In order to deploy changes <br />
Follow these steps: <br />
'Advanced'->'File Manager'->'public_html'->'Upload'

Select 'Overwrite' then carry over project files needed to deploy/update for the website.

In the event of a domain name change, consult with the business owner for decision making and <br />
payment decisions. The same applies to hosting services.<br />
● Ensure that php version 8.1.12 or later is installed on your server or your hosting provider’s <br />
server. Please consult the official PHP documentation on installation details and instructions. <br />
○ [PHP](https://www.php.net/manual/en/install.php) <br />
● Ensure that mySQL version 5.7.23 or later is installed on your server or your hosting provider’s <br />
server. Please consult the official mySQL documentation on installation details and instructions. <br />
○ [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/) <br />
● Ensure that Composer is installed. Please consult the official Composer documentation on <br />
installation details and instructions. <br />
○ [Composer](https://getcomposer.org/download/) <br />
● All of the above were pre-installed on our current hosting service provider, BlueHost. The <br />
operating system on their server is Linux with kernel version 4.19.150-76.ELK.el7.x86_64. <br />
● Ensure that the PayPal PHP SDK is installed. With an SSH connection to the server, navigate to <br />
the root directory of your project (not the server root directory) and execute the following <br />
command: composer require paypal/rest-api-sdk-php:* <br />
○ To clarify further, the SDK should be installed in the directory that will hold all of the files <br />
that will be publicly accessible. <br />
○ After composer installs the SDK, you should see a ‘vendor’ directory that has the PayPal <br />
SDK. Do not overwrite or delete this directory. <br />
● You should now have all of the tools for the website to function. Simply migrate your files to the <br />
directory that will be publicly accessible to the web, but make sure not to overwrite the ‘vendor’ <br />
directory. <br />
○ Please reference the existing webhook configuration to create new webhooks if needed. <br />
○ common.php and bootstrap.php need to be moved to <br />
/vendor/paypal/rest-api-sdk-php/lib/ in order for the SDK to function. Examples of each <br />
can be found in the root directory of the GitHub repository. <br />



## Prototype:
![](/ProtoTypeImages/HomePage.png)
![](/ProtoTypeImages/ServicesPage.png)
![](/ProtoTypeImages/LoginPage.png)
![](/ProtoTypeImages/SignUpPage.png)
![](/ProtoTypeImages/AccountDetailsPage.png)
![](/ProtoTypeImages/AdministrationPage.png)
![](/ProtoTypeImages/ContactMePage.png)

## JIRA Timeline:

### Sprint 01

Draft project charter document 

Meet with client for initial requirements and details elicitation

### Sprint 02

Decide on tech stack and development tools

Create a mockup of the website

### Sprint 03

Construct homepage

Create Services Page

Construct login Page

Construct signup page

### Sprint 04

Create database to store user information

Host database for initial testing

Add drop down menu to all pages

Add dark mode and light mode 

### Sprint 05

Add functionality for user to delete account and all associated data

Add functionality for customers to request additional filter washes

Add functionality for customers to request services without an account 

### Sprint 06

Add functionality to cancel subscriptions

Add administrative functionality (update service pricing and descriptions)

### Sprint 07

Implement payment system

Store payment details in database

Ensure records are accessible from client and administrative view

### Sprint 08

Deploy website and conduct final testing 

### Sprint 09
Polishing up the website to look nice and proper
to get ready for handing off to the business owner

### Sprint 10
System Test Report, User Manual and Maintenance Manual documentation focus

Final function testing and a look over of the final product of the web application

Handing off to the business owner and signing off on Product Delivery

## Application Flow:
![](/Diagrams/applicationflow.png)

## ER diagram:
![](/Diagrams/erd.png)
