<?php
include_once("connect.php");
$sql_selabbre = @mysqli_query("SELECT node.title, field_data_body.body_value FROM node, field_data_body WHERE node.type = 'abbreviations' AND field_data_body.entity_id = node.nid AND node.status =1 order by node.title");
$num = mysqli_num_rows($sql_selabbre);
if ($num > 0) {
    ?>
    <div class="glossary-desc">
        <h1>Glossary</h1>
        <div class="article-desc">
            <?php
            $c = 0;
            while ($d_abb = mysqli_fetch_array($sql_selabbre)) {
                $start = substr($d_abb['title'], 0, 1);
                $sql_nodewithchar = @mysqli_query("select title from node where substr(title,1,1)='" . $start . "' and type='abbreviations' and node.status=1");
                $numofrows = mysqli_num_rows($sql_nodewithchar);
                {

                    //$counter=$numofrows;
                    $counter = 1;
                    while ($d = mysqli_fetch_array($sql_nodewithchar)) {
                        //$counter++;
                        $counter++;
                    }
                }
                //	echo "Counter = > ".$counter;
                //if($start==)
                $c++;
                //echo "<br />"."New Counter = > ".$c;

                //echo substr($d_abb['title'],0,1)."<br />";
                ?>
                <h3<?php if ($c == $numofrows) { ?> class="padB10"<?php $c = 0;
                } ?>><?php echo $d_abb['title'];?><span>- <?php echo $d_abb['body_value'];?></span></h3>
            <?php
            }
            ?>

        </div>
        <!-- description flow -->
    </div>



<?php
}
?>
