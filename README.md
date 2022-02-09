<h1 align="center">
DogeGarden
<br><br>
<img src="https://dogegarden.io/img/dogeGarden.png" alt="Dogecoin Christmas Calendar"/>
<br><br>
</h1>

## How to Install 💻

1- Get an Hosting Account or Web Server that supports ```PHP (V. 7 =>)``` + ```MySQL/MariaDB``` (also works locally with Docker or Xampp for exemple)

2- Create an Data Base and import the file ```dogegarden.sql```

3- Install Dogecoin Core Wallet and enable RPC calls: https://github.com/dogecoin/dogecoin/blob/master/doc/getting-started.md

4- Open the file with any text editor ```inc/config.php``` and follow the configurations needed

5- Upload all files (excluding dogegarden.sql and readme.md) to your Hosting Account.

6- Add a cron task to the file cron.php, and let it run every minute and enjoy it :)

###Notes:
- This is a Beta Version so is best for now only use on DogeCoin Core Wallet on TestNet untill more people test it and see if everything is ok :)
- Open the files, try to understand how it works, make some changes and test it, learn with this :)
- Will later add an easy install interface, some video tutorials etc.
- I need your help on improving DogeGarden :)
- To add a transation file just create a 2 letter file of your country and include on the inc/lang/ folder like the 2 exemples in English and Portuguese 