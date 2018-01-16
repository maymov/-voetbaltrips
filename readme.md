# Voetbaltrips


# Start building
* clone

* .env changes

* composer install
* php artisan migrate
* php artisan db:seed

php artisan key:generate
-

# Tools needed
* Vagrant (https://www.vagrantup.com)
* VirtualBox (https://www.virtualbox.org)
* Git bash (https://git-scm.com/downloads)
* (Optional if preferred) GitHub(installs "GitBash" which we need) (https://windows.github.com/)
* SourceTree (http://www.sourcetreeapp.com/)
* Netbeans or PHPStorm or any other IDE that you are comfortable with. (https://netbeans.org)
* MySQL Workbench (http://www.mysql.com/products/workbench)
* Laravel Homestead
* Laragon (https://laragon.org/)

# Step 0
* Install the tools that we need.

# Step 1
* Open SourceTree
* On the top left click "Clone/New"
* Set "Source Path / URL" to this repository
* Set "Destination Path" to a new folder you created for this project, for example a folder inside your documents directory.
* You could leave the other default settings as they are.
* Click "clone"

# Step 2
* open a laragon shell/terminal window
* Browse to the destination folder we just used in the previous step.
* Once in the folder do "vagrant up". The server image box is now automatically being downloaded and configured.
* Once finished you should be able to browser to voetbaltrips.dev in your browser installed, else adjust the hosts file first to point the domain to 192.168.10.10 )

# Step 3 - Database control
* Open phpmyadmin through laragon
* create a db for voetbaltrips

# Step 4 - Start building
* clone
* .env changes
* composer install
* php artisan migrate
* php artisan db:seed
* php artisan key:generate

# Step 5 - Using SourceTree
* If there are changes in the remote origin repository you will see a red icon next to the "pull" arrow at the top.
* Click the pull arrow to pull the changes in, normally this won't cause any conflicts.
* If you made and commit changes that are not yet pushed to the remote origin repository you will see a red icon next to the "Push" arrow. Click the push arrow to push the changes to the remote origin for that branch.
* Start your work day by pulling and pull whenever the arrow shows that there are things to pull.
* Commit often whenever changes to a function are made for example
* Push after a task is done, at least at the end of the day

# Step 6 - Enjoy Coding
* Start your day by running "vagrant up" inside the Homestead folder if you are not using laragon.
* Pull the last changes from GitHub through Sourcetree
* Code
* Commit
* Code
* Commit
* Push
* When done for the day
* commit and push the last changes
* Then run "vagrant suspend" in the project folder if you are not using laragon
* "vagrant suspend" will keep the current state of the server so you can "vagrant up" again any time you want to visit the app or code again.

# Step 7
* Live
* &
* Learn