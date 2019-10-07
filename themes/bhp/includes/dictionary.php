<script type="text/javascript">
$(document).ready(function(){
$("#dictionarylist a").click(function(){
$("#dictionarylist a").removeClass("active");
$(this).addClass("active");
});
});
</script>
<?php
include_once("connect.php");
$sql_dictionary=@mysqli_query("SELECT node.title, field_data_body.body_value FROM node, field_data_body WHERE node.type = 'dictionary' AND field_data_body.entity_id = node.nid AND node.status =1 and substr(node.title,1,1) like '%a'order by node.title");
$num=mysqli_num_rows($sql_dictionary);
if($num>0)
	{
?>
<div class="tab_content">
	<div class="clearfix">
		<div class="clearfix">
			<div class="glossary fleft w460" id="dictionarylist">
				<a href="#" onclick="javascript:show_byalphabet('A'); return false;" class="active">A</a><a href="#" onclick="javascript:show_byalphabet('B'); return false;">B</a><a href="#" onclick="javascript:show_byalphabet('C'); return false;">C</a><a href="#" onclick="javascript:show_byalphabet('D'); return false;">D</a><a href="#" onclick="javascript:show_byalphabet('E'); return false;">E</a><a href="#" onclick="javascript:show_byalphabet('F'); return false;">F</a><a href="#" onclick="javascript:show_byalphabet('G'); return false;">G</a><a href="#" onclick="javascript:show_byalphabet('H'); return false;">H</a><a href="#"  onclick="javascript:show_byalphabet('I'); return false;">I</a><a href="#" onclick="javascript:show_byalphabet('J'); return false;">J</a><a href="#" onclick="javascript:show_byalphabet('K'); return false;">K</a><a href="#" onclick="javascript:show_byalphabet('L'); return false;">L</a><a href="#" onclick="javascript:show_byalphabet('M'); return false;">M</a><a href="#" onclick="javascript:show_byalphabet('N'); return false;">N</a><a href="#" onclick="javascript:show_byalphabet('O'); return false;">O</a><a href="#" onclick="javascript:show_byalphabet('P'); return false;">P</a><a href="#" onclick="javascript:show_byalphabet('Q'); return false;">Q</a><a href="#" onclick="javascript:show_byalphabet('R'); return false;">R</a><a href="#" onclick="javascript:show_byalphabet('S'); return false;">S</a><a href="#" onclick="javascript:show_byalphabet('T'); return false;">T</a><a href="#" onclick="javascript:show_byalphabet('U'); return false;">U</a><a href="#" onclick="javascript:show_byalphabet('V'); return false;">V</a><a href="#" onclick="javascript:show_byalphabet('W'); return false;">W</a><a href="#" onclick="javascript:show_byalphabet('X'); return false;">X</a><a href="#" onclick="javascript:show_byalphabet('Y'); return false;">Y</a><a href="#" onclick="javascript:show_byalphabet('Z'); return false;">Z</a>
			</div><!-- fleft -->
			<?php
				include_once("././themes/bhp/includes/common/share.php");
			?>
		</div><!--clearfix -->
		
		<div class=" marT20 clearfix">
			<div class="descripptionFlow">
				<div id="ajax">
				<?php
				while($d_dic=mysqli_fetch_array($sql_dictionary))
					{
				?>
				<h3><?php echo $d_dic['title'];?></h3> 
				<p><?php echo $d_dic['body_value'];?></p>
				<?php
					}
				?>
				</div>
			</div><!-- description flow -->
			
		</div><!-- full news -->
			
	</div><!-- news deatils -->
</div><!-- tab content -->
<?php
	}
?>
