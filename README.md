![BLUELOCK](https://www.dafont.com/forum/attach/orig/1/1/1113252.png?1 "BLUELOCK LOGO")

# BlueLock - The Ultimate Sports Social Network 🏆

Welcome to **BlueLock**, the 100% sports social network created by **Mèjdi Alaoui**, **Mohamed Benteboula**, and **Riad Rhoulam**!

Imagine a platform made *just* for sports enthusiasts like you:

👉 Live match results

👉 A community of fans

👉 Create or join events

👉 Represent your favorite clubs

👉 Personalize your profile...

Basically, everything you need to fully enjoy your passion for sports!

---

## 🚀 Main Features

- **Live Match Results**
    
    Stay up to date with the latest football match scores *directly in the app* (currently football only, but don’t worry — more sports are on the way 😉).
    
- **Community Feed**
    
    Post, comment, share your thoughts about matches, events, clubs... engage with other fans who are just as hyped as you are!
    
- **Event Creation**
    
    Organize your own tournaments, training sessions, or sports meetups — and invite everyone to join!
    
    You can even see who’s attending your events in real time.
    
- **Join a Club**
    
    Choose your club from among top pro teams in Europe’s biggest leagues and show off where you play! ⚽
    
    (Flex on your friends if you’re in a big club 👀)
    
- **Follow System**
    
    Follow inspiring players and build your own community.
    
- **Customizable Profile**
    
    Change your username, bio, or profile picture whenever you like!
    
- **Ultra-Fast Full-Text Search**
    
    Looking for a nearby event? A hot take on a match?
    
    Just type it in the search bar and *BOOM* — instant results!
    

---

## 🛡️ Moderation Tools

To keep things respectful and fun, **admins can**:

- Delete user accounts
- Remove posts
- Delete events

(Only if they break the rules, of course 👮‍♂️)

---

## 📋 Important Info Before Getting Started

**Quick tip**: When you first log into BlueLock, head over to the **BlueSport** section to **sign up for your favorite sport(s)**.

👉 By registering your sports, you’ll unlock the ability to **post**, **create events**, and **see events** related to your interests!

*(PS: The list of available sports will grow based on community requests — feel free to suggest new ones! 😉)*

---

## ⚙️ Tech Stack

This project is built with a full PHP stack:

- **Backend**: PHP 8.2 + Laravel
- **Frontend**: Blade components, Tailwind (for initial setup), and good ol’ HTML/CSS
- **Database**: SQLite (simple, fast, and efficient)
- **API**: Uses an external API to fetch live match scores
- **OAuth Login**: Google login integration for the lazy legends out there

---

## 🛠️ Behind the Scenes

We followed a classic Laravel architecture:

- **Routes** → lead to **Controllers**
- **Controllers** → handle all logic (events, signups, posts...)
- **Views** → display the data in a clean interface
- **Database** → stores users, events, posts...

Every page is based on the main layout file `app-layout`, which handles the global structure (sidebar, header, background, etc.)

---

## 🧠 Tricky Parts

There weren’t any *super complex* features (thanks Laravel ❤️), but a few things gave us a hard time (and shoutout to AI for the help on these):

- **Google OAuth login** → was a pain to configure initially
- **Football API** → integrating real-time scores without breaking the app
- **CSS organization** → we started manually, then used AI to quickly generate consistent styles based on our base design — saved a ton of time (beauty wasn't our top priority)

---

## 📖 Quick Demo

Wanna test the app?

Here you go!

**User Account**:

- ID: [`julien.caposiena@gmail.com`](mailto:julien.caposiena@gmail.com)
- Password: `j@imelephp8.2!`

**Admin Account**:

- ID: `admin`
- Password: `admin1234`

*(Yes, it’s not super secure — remember this isn’t a production project 😉)*

---

## 🛠️ Installation Tips

Once you unzip the project, **make sure to install it on a local drive**, not an external one!

⚠️ Otherwise, features like **image uploads** (profile pics, post images, etc.) **won’t work properly**.

### Before launching the project with `php artisan serve`:

There are a few essential setup steps:

---

### 1. SSL Certificate for the API

The score-fetching API requires a **server-side SSL certificate** on your machine.

- **On Windows** (our case):
    
    Download `cacert.pem`, place it in your PHP directory (e.g. `C:\Program Files\PHP\php-xxx`)
    
    Then, open `php.ini` and set the full path next to `curl.cainfo`.
    
- **On Ubuntu** (lucky you):
    
    ```bash
    sudo apt-get update
    sudo apt-get install ca-certificates
    sudo update-ca-certificates
    
    ```
    

---

### 2. File Handling in the `storage` Folder

Files like post images and profile photos are **not tracked by Git**, because folders like `storage` are in `.gitignore`.

So, after cloning the repo, unzip the extra folder we provided (called **aDezipper**) and copy the following folders into `/storage/app/public`:

- `post`
- `profile_photos`
- `reports`

Then (very important for image display!), run:

```bash
php artisan storage:link

```

---

### 3. Install Dependencies

Once everything above is done, run:

- `composer install`
- `npm install`
- `npm run build`

---

And now... **Launch the project with `php artisan serve`** and enjoy the **BlueLock experience** 😍

---

## PS

🔜 The right-hand vertical panel (with trends and suggested profiles) is coming soon!

Right now, it's just placeholder content 😅 — but it’s on the roadmap.

🔜 We did not implement the daily reporting feature (CSV export with task scheduling and job execution). After some research, we found that our project does not include the Console directory (and therefore no Kernel.php), which is required to schedule jobs in Laravel.

Since we started working on this feature late in the project, we decided not to create the missing files manually to avoid risking breaking the project at the very end of development.

Thanks for reading our README!

---

## *BlueLock – A network made by sports lovers, for sports lovers.*

![Gif Bluelock](https://www.icegif.com/wp-content/uploads/2023/04/icegif-1263.gif "gif bluelock")
