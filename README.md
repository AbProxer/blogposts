
## Please run the commands in the order as given below:

### to run application :
1. composer install
2. npm install
3. php artisan server
4. npm run dev

### to run test cases :
 php artisan test


# Your coding challenge

Welcome to your coding challenge.

## Basic rules

* You have 8 hours to implement the tasks listed below.
* We’ll be taking into account that the 8 hours working time include total breaks of 45 minutes.
* We expect you to turn in your results as a git repository either on a git provider of your choice or as a git repository in a ZIP file.
* You can use any technology you like. We’d propose Laravel as a basic framework with maybe a small Vue.js frontend, but if you would prefer anything else (choose technology you know and like to work with) that’s also fine.
* You can use the tools you like. When using generative AI (like ChatGPT) please let us know where and why it was used.
* Commit early, commit often. In the final repo we’d like to be able to very roughly see the process of how your task evolved. For this you can use something like gitwatch or commit manually every now and then.
* The task descriptions are **not** very detailed. Everything that is not explicitly written down can be interpreted as you like. Be creative.

Have fun!

## Your tasks

We split up the tasks into multiple steps. The order of tasks is random, feel free to work on what you feel matches your skillset best or shows most of how you work.

### Core Task: MicroCMS

**This is the main task that you should start with as all other tasks are built on top of this.**

In `/resources/data/posts.json` you'll find a list of blog posts. Your task is to build a small CMS that reads posts from this file, allows adding new posts or removing old posts. Also a public frontend should display the posts in a blog post fashion, meaning an overview of all available posts and a single page view for each blog post.

Task requirements:

* Backend: Posts must be read from and written to posts.json
* Backend: It must be possible to add new posts and delete old posts
* Frontend: The posts should be in chronological order of their appearance
* Frontend: The blog can be text only
* Frontend: Use data from the posts.json to display the posts pages in a way that you'd expect to see somewhere online
* Testing:
  * Add functional tests for all HTTP endpoints (frontend and backend)
  * Add unit tests to all standalone service classes you build for the backend
  * Do NOT add unit tests for things like controllers, requests, etc.. Only test business logic

### Additional tasks

In case you get bored or you have too much time at hand, here are some additional tasks:

#### Post editing

Add editing abilities for existing posts. Feel free to modify the posts.json file to be able to identify the posts.

Additional requirement: It should be visible in the frontend if posts got redacted an when they were last edited.

#### Post generation

Add a button to the backend to generate new posts based on a request to a generative text ai.

* The new posts must match the topic, style, etc. of the existing interviews.
* Allow entering a person to get an interview from

#### Post versioning

Add versioning of the posts.json.

* Keep a configurable number of old versions. The configuration should be in a Laravel config file.
* Allow restoring old versions of single posts, this should create a new version containing the newest version of all other existing posts + the selected restored version.

#### Upload of post pictures

Add uploading of images for posts.

* Allow uploading jpg or png files
* Require useful sizes (not too small, not too big)
* Use the uploaded images to improve the post's page in the frontend.

## Reminder

The additional tasks are just here to keep you busy. If you have time, pick whatever you like. We know that doing all tasks is impossible within the given time.

## Recommendations

* For all things you'd like to say or note, create a file COMMENTS.md in the project root. We'll first read this file when opening your results.
* We'd recommend using Laravel and Vue.js. If you have better ideas, feel free to choose whatever you like. Please leave a comment about why you chose what you chose.
* For the backend, we'd recommend to focus on the blog parts. Skip authentication, it's not part of the requirements.
* Use a premade theme for both frontend and backend parts or just apply very basic stylings with something like tailwind. Do not focus on how it looks. We won't either (promised).

## Confidentiality note

The task, along with any related information, is considered proprietary and confidential to our company. As such, we must ensure that it remains protected from unauthorized disclosure or sharing with third parties.

Therefore, I kindly remind you that:

* The coding task and any associated materials must not be shared publicly on the internet, social media, or any other media platform.
* You must refrain from discussing the specifics of the task outside of your communication with our company or with individuals who are not part of our hiring process.
* Any documentation or materials related to the task should be securely stored and not accessible to unauthorized personnel.

As part of our commitment to safeguarding our intellectual property and maintaining confidentiality, we expect you to adhere strictly to these guidelines.
