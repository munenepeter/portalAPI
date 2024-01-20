Test Project

How would you go about building a system like this?

A web application(Portal) that does not have direct database access needs to allow authorized users to log in and change their email address.

The portal will interact with the database through an independent RESTful API web application (PortalAPI) which has access to the database.

Requirements: 

Use of TALL stack or Laravel/Tailwind CSS/Vue.js.
A user will request a login link by providing their email address(no use of passwords). The API will then send a time-limited login link to their email address. Once the link is clicked (within the time limit) we will invalidate it and allow the user to access the portal home screen for their account. 
The portalapi shall use JWT for authentication.
Laravel conventions/best practices and PSRs must be followed.
Be extremely distrustful of the user’s input. Validation of user input is mandatory.

We are interested in understanding:

How you would approach designing this project (from a software engineer’s mindset standpoint)
The code you deliver to power the project

Code deliverables:

Bitbucket or git repositories for the portal, portalapi laravel projects with env.local files included
MySQL dump of the database with test users provided so that we can quickly test your work

Submission: 

Please use this Google form to submit all deliverables for the test project 

Thank you so much for your interest and we greatly appreciate the time you’re taking to do this project. We sincerely hope you become a great long-term fit for our team!
