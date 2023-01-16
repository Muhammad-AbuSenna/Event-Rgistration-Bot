# Event-Rgistration-Bot

# Introduction:

Sometimes we need to interact with our robots from anywhere and even make them accessible to any user on large scale. Sometimes I need to be out and be able to provide my robot with some data to process on my PC or even a company server. It is not reasonable that I have my PC with me everywhere so I can launch the robot to process my data. So, what is more reliable and accessible from anywhere than web application! They have a customizable, user-friendly UI, it can be accessed from multiple devices operating with different OS.

The **Uipath Orchestrator API** provides ways to connect to your robot and orchestrator through your **External Applications** (android, IOS, desktop and web applications). i.e., Any technology that provides a way to connect through APIs.

I do have some experience with web technologies so I decided to create a web app that I will provide it with some data, then it will send it to the robot through API calls.

# Project Description:

Sending invitation emails can be tedious work to the responsible team in an organization for each event they create. My project is about making this process automated by making the guest to fill in the online form and submit his request, these data will be sent to an orchestrator queue that will hold the user details and then comes the robot work.

**The robot will:**

-   Generate a custom user ID.
-   Generate a QR code image encoded with user details and his custom ID.
-   Send invitation email with the QR code image to user account he provided in his details.
-   Save the user details along with his custom ID in Excel sheet database for later validation by scanning the QR code image and match the custom ID to the one in our database.

My project was built upon the concept of **Dispatcher** and **Performer** model so let us discuss what technologies they are built with and how to configure them to make the project be able function.

# **Important**:

This was a brief description of the project; you need to read the **Project Aspects - Event Registration Bot.pdf** file for full documentation and configuration of the project.
