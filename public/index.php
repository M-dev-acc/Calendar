<?php
include '../vendor/autoload.php';
include_once('../core/Calendar.php'); 
include_once('../core/Event.php'); 
include_once('../core/DateTimeHelper.php'); 
?>
<?php
$currentYear = date('Y');
$calendar = new Calendar($currentYear);

if (isset($_POST)) {
    if (!empty($_REQUEST['event']) && !empty($_REQUEST['scheduled_at'])) {
        $event = new Core\Event();
        $status = $event->createEvent($_REQUEST);
        unset($_REQUEST);
        echo "Data is stored!";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
</head>
<body>
    <header>
        <nav>
            <h3>Calendar</h3>
        </nav>
    </header>
    
    <main>
        <section>
            <header>
                <fielset>
                    <legend>Create an event</legend>
                    <form action="<?=$_SERVER['PHP_SELF']; ?>">
                        <input type="text" name="event" id="">
                        <input type="date" name="scheduled_at" id="">
                        <input type="submit" value="Create an event">
                    </form>
                </fielset>
            </header>
            <?php foreach ($calendar->getDaysOfMonths() as $key => $monthInfo): ?>
            <table border="1">
                <caption>
                    <?=$monthInfo['name']; ?> 
                    <?php
                        $date = "01-$key-$currentYear";
                        $dateClass = new DateTimeHelper();
                        $var = $dateClass->week();

                        var_dump($var);
                    ?>
                    
                </caption>
                <thead>
                    <tr>
                        <?php foreach ($calendar->getDaysOfWeek() as $dayName) : ?>

                        <th>
                            <?=$dayName; ?>
                        </th>

                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                <?php for ($week=0; $week < 5; $week++): ?>
                    <tr>
                    <?php for ($day=0; $day < 7; $day++): ?>
                        <td>&nbsp;</td>
                    <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>

    </footer>
</body>
</html>