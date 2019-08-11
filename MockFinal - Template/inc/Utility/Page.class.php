<?php
//CSS Grid adotped from : https://www.w3schools.com/css/css_grid.asp


class Page  {

    //Title - MAKE SURE YOU SET THIS!
    private static $title = "MidtermSHi_56789 - Bookstore Garment Request";

    static function setTitle(string $title) {
    }

    static function header()    { ?>
    
    <!DOCTYPE html>
    <html>
    <head>
    <title>
        <?php echo self::$title; ?>
    </title>
    <link rel="stylesheet" href="css/grid.css">
    </head>
    <body>

    <div class="grid-container">
    <div class="item1"><H1><?php echo self::$title; ?></H1></div>

    <?php }

    static function footer()    { ?>

    </body>
    </html>

    <?php }

        static function editform($species,$id)
        {?>

            <div class="item3">
            <form action ="" method = "POST">
            Weight: 
            <input type="text" name = "weight"><br>
            Length: 
            <input type="text" name = "length"><br>
            <select name = "commonname">
            <?php
            foreach($species as $sp)
            {?>
                <option value = "<?php echo $sp->getCommonName()?>"><?php echo $sp->getCommonName()?></option>
            <?php } 
            ?>
            </select>
            <input type = "hidden" name ="action" value = "edit">
            <input type = "hidden" name ="id" value = <?php echo $id?>>
            <input type ="submit" value = "Edit">
            </form>
        
                </div> 
        
            <?php

        }


    static function speciesForm($species)    { ?>

    <div class="item3">
    <form action ="" method = "POST">
    Weight: 
    <input type="text" name = "weight"><br>
    Length: 
    <input type="text" name = "length"><br>
    <select name = "commonname">
    <?php
    foreach($species as $sp)
    {?>
        <option value = "<?php echo $sp->getCommonName()?>"><?php echo $sp->getCommonName()?></option>
    <?php } 
    ?>
    </select>
    <input type = "hidden" name ="action" value = "create">
    <input type ="submit" value = "Add to Log">
    </form>

        </div> 

    <?php }

    static function showLog($logs)    {

    echo '<DIV CLASS="item4">';
    echo '<p>fishing Log</p>';
    if (empty($logs))   {
        echo '<p>No logs to show at this time.</p>';
    } else {
        
        echo '<TABLE>
                <tr>
                    <TH>Weight</TH>
                    <TH>Length</TH>
                    <TH>Species</TH>
                    <TH>LogDate</TH>
                    <TH>Delete</TH>
                    <TH>Edit</TH>
                </tr>';
        
        foreach($logs as $log)
        {
            echo '<TR>
                <TD>'.$log->getWeight().'</TD>
                <TD>'.$log->getLength().'</TD>
                <TD>'.$log->getSpecies().'</TD>
                <TD>'.$log->getLogstamp().'</TD>   
                <TD> <a href=?action=delete&id='.$log->getId().'>Delete</a></TD> 
                <TD> <a href=?action=edit&id='.$log->getId().'>Edit</a></TD> 
            </TR>';
               
        }
        echo '</TABLE>';

    }

    echo '</DIV>';

    }

    static function showMessages($messages)  {

            echo '<div class="item6">';
            echo '<UL>';
            if (!is_array($messages))   {
              
            } else {
                foreach ($messages as $message) {
                  echo $message;
                }
            }
            echo '</UL>';
            echo '</div>';
        
    }

    static function XMLExport() { ?>
    
    <DIV class="item2">
    Click <A HREF="ExportfishLog.php">here</A> to Export to XMLExport
    </DIV>

<?php }
}


?>