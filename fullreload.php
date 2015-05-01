<?php

// you'd get this from the DB, but for brevity, I'll use an array
$subjectOptions = array(
    1 => 'Subject 1',
    2 => 'Subject 2',
    3 => 'Subject 3'
);

// same for these
$sectionOptions = array(
    1 => array(
        1 => 'Subject 1 - Section 1',
        2 => 'Subject 1 - Section 2',
        3 => 'Subject 1 - Section 3'
    ),
    2 => array(
        1 => 'Subject 2 - Section 1',
        2 => 'Subject 2 - Section 2',
        3 => 'Subject 2 - Section 3'
    ),
    3 => array(
        1 => 'Subject 3 - Section 1',
        2 => 'Subject 3 - Section 2',
        3 => 'Subject 3 - Section 3'
    )
);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Full page reload demo</title>
</head>
<body>
<form action="fullreload.php" method="POST">
    <label for="subject">Select your subject</label>
    <select name="subject">
        <option value=""></option>
        <?php
            foreach ($subjectOptions as $key => $subject) {
                if (isset($_POST['subject']) && $_POST['subject'] == $key) {
                    echo '<option value="' . $key . '" selected="selected">' . $subject . '</option>';
                } else {
                    echo '<option value="' . $key . '">' . $subject . '</option>';
                }
            }
        ?>
    </select>

    <?php if (isset($_POST['subject']) && !empty($_POST['subject'])) { ?>
        <br />
        <label for="section">Select your section</label>
        <select name="section">
            <option value=""></option>
            <?php
                foreach ($sectionOptions[$_POST['subject']] as $key => $section) {
                    if (isset($_POST['section']) && $_POST['section'] == $key) {
                        echo '<option value="' . $key . '" selected="selected">' . $section . '</option>';
                    } else {
                        echo '<option value="' . $key . '">' . $section . '</option>';
                    }
                }
            ?>
        </select>
    <?php } ?>

    <br />

    <?php if (!isset($_POST['subject']) || empty($_POST['subject'])) { ?>
        <button type="submit">Find sections</button>
    <?php } else if (!isset($_POST['section']) || empty($_POST['section'])) { ?>
        <button type="submit">Submit</button>
    <?php } else { ?>
        <dl>
            <dt>Subject</dt>
            <dd><?php echo $subjectOptions[$_POST['subject']] ?></dd>

            <dt>Section</dt>
            <dd><?php echo $sectionOptions[$_POST['subject']][$_POST['section']] ?></dd>
        </dl>

        <a href="fullreload.php">Reset</a>
    <?php } ?>
</form>
</body>
</html>
