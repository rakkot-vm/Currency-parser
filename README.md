<h3>INFO</h3>
<ul>
    <li>name: Currency Parser</li>
    <li>Yii2 Cron PHP JavaScript HTML</li>
</ul>

<h3>Specification</h3>
<h5>Implement a price parser for different currencies in Ukraine (PHP)</h5>
<ul>
    <li>Source: https://korrespondent.net/business/indexes/course_valjut/</li>
    <li>only OOP</li>
    <li>The obtained data is stored in the database, the prices are stored with reference to the date.</li>
    <li>Using Bootstrap, output from the database prices for a certain date, realize the possibility of selecting a date through the widget.</li>
    <li>Add the ability to make a note to the current value by region for the selected day</li>
    <li>When 12:00 comes, send to the mail (***); two ways.</li>
    <li>Implement the means of the database as a separate store of the mean value of the day at midnight.</li>
    <li>It will be a plus dynamic update of prices when changing the date, that is, using AJAX and implement sorting at prices, as at the source.</li>
    <li>It should be on a Nix server.</li>
</ul>

<p style="font-weight: bolt;">
To start the project, you must create an environment with the file puphpet-config.yaml(it contains Cron tasks) and service puphpet.com and enable the migration.Also it is necessary to set the database settings in "config/db.php" and configure smtp and mail in "config/params.php"
</p>
