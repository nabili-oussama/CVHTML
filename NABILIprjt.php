<!doctype HTML>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
error_reporting(0);
    session_start();
    $file = fopen('elevesYm2.csv', 'r');
        while (!feof($file)) {  
            $csv[] = fgetcsv($file, 1024); 
        }
        fclose($file);
    function swt($m , $n) {
        $file = fopen('elevesYm2.csv', 'r');
        while (!feof($file)) {  
            $csv[] = fgetcsv($file, 1024); 
        }
        fclose($file);
        for($i = $m ; $i <= $n ; $i++) {
            for($j = 0 ; $j < 2 ; $j++) {
                echo $csv[$i][$j];
                if( $j == 1  && ! (empty($csv[$i]))) {
                    echo '<pre>';
                    echo '</pre>';
                    ?>
                    <table style="float: left; margin-right:10px">
                    <tr>
                        <th>Binaire</th>
                        <th>Décimal</th>
                        <th>Octal</th>
                        <th>Hexadécimal</th>
                    </tr>
                    <tr>
                    <td> <?php $bin = intval(decbin(rand(100,400))); echo $bin ?></td>      
                    <?php for($k =1; $k <= 3; $k++) {?> <td> <?php echo '...'; ?> </td> <?php } ?>  
                    </tr>
                    <tr>
                    <td> ...</td>  
                    <td> <?php $dec = rand(200,400); echo $dec ?></td>  
                    <?php for($k =1; $k <= 2; $k++) {?> <td> <?php echo '...'; ?> </td> <?php } ?>     
                    </tr>
                    <tr>
                    <?php for($k =1; $k <= 2; $k++) {?> <td> <?php echo '...'; ?> </td> <?php } ?>      
                    <td> <?php $oct = intval(decoct(rand(100,400))); echo $oct ?></td>  
                    <td> ... </td>   
                    </tr>
                    <tr> 
                    <?php for($k =1; $k <= 3; $k++) {?> <td> <?php echo '...'; ?> </td> <?php } ?>         
                    <td> <?php $hex = dechex(rand(0,400)); echo $hex ?></td>  
                    </tr>
                </table>
                <table style="float: center;margin-right:10px">
                    <tr>
                        <th>Binaire</th>
                        <th>Décimal</th>
                        <th>Octal</th>
                        <th>Hexadécimal</th>
                    </tr>
                    <tr>
                        <td> <?php echo $bin ?></td>      
                        <td><?php echo $a = intval(bindec($bin))?></td>
                        <td><?php echo decoct($a)?></td>
                        <td><?php echo dechex($a)?></td> 
                    </tr>
                    <tr>
                        <td> <?php echo decbin($dec) ?></td>  
                        <td> <?php echo $dec ?></td>  
                        <td> <?php echo decoct($dec) ?> </td> 
                        <td> <?php echo dechex($dec) ?> </td>     
                    </tr>
                    <tr>
                        <td> <?php $b = intval(octdec($oct)); echo decbin($b) ?></td>  
                        <td> <?php echo $b ?></td>  
                        <td> <?php echo $oct ?> </td> 
                        <td> <?php echo dechex($b) ?> </td>     
                    </tr>
                    <tr>
                        <td> <?php $c = intval(hexdec($hex)); echo decbin($c) ?></td>  
                        <td> <?php echo $c ?></td>  
                        <td> <?php echo decoct($c) ?> </td> 
                        <td> <?php echo $hex ?> </td>     
                    </tr>
                    </table>
                    <div></div> <?php
                    echo '<pre>';
                    echo '</pre>';                  
                } 
            }   
        }
    }
?>
<h2> 
    <?php  
        if (empty($_POST) && ! isset($_SESSION['a'])) {
            $a = 1; 
        }
        else if (! empty($_POST)) {
            $n = array_keys($_POST)[0];
            if (in_array($n, array('Suiv', 'Prec'))) {
                $a = $_SESSION['a'];
                if (strcmp($n, 'Prec') && $a < count($csv)) { 
                    $a += 2; 
                }
                else if (strcmp($n, 'Suiv') && $a > 1) { 
                    $a -= 2; 
                }
            } 
            else {
                $n = intval($n);
                $a = $n * 2 - 1; 
            }
        } 
        else { 
            $a = $_SESSION['a']; 
        } 
        $_SESSION['a'] = $a;
        $b = $a + 1;
        swt($a, $b);  
    ?> 
    <form method="post" style="text-align:center"> <br> 
        <input type="submit" name="Prec" value="<< BEFORE" /> &nbsp;&nbsp;&nbsp;
        <?php for($k =1; $k <= intval(count($csv)/2); $k++) {?> 
            <input type="submit" name="<?php echo $k ?>" value="<?php echo $k ?>"> &nbsp;&nbsp;&nbsp; 
            <?php  } ?> 
        <input type="submit" name="Suiv" value="NEXT >>"/> <br> <br>
        <input type="button" value="PRINT" onclick="window.print();" />
    </form>
</h2>
</body>