<?php
include_once("connect.php");
$sql_selabbre=@mysqli_query("SELECT node.title, field_data_body.body_value FROM node, field_data_body WHERE node.type = 'abbreviations' AND field_data_body.entity_id = node.nid AND node.status =1 order by node.title");
$num=mysqli_num_rows($sql_selabbre);
if($num>0)
	{
?>
<div  class="tab_content">
<div class=" clearfix">
		<div class="clearfix">
			<?php
				include_once("././themes/bhp/includes/common/share.php");
				?>
		</div><!--clearfix -->
		<div class=" marT10 clearfix">
			<div class="descripptionFlow glossary">
				<?php
				$c=0;
				while($d_abb=mysqli_fetch_array($sql_selabbre))
					{					
					$start=substr($d_abb['title'],0,1);
				  $sql_nodewithchar=@mysqli_query("select title from node where substr(title,1,1)='".$start."' and type='abbreviations' and node.status=1");
				  $numofrows=mysqli_num_rows($sql_nodewithchar);
							{
							
							//$counter=$numofrows;
							$counter=1;
							while($d=mysqli_fetch_array($sql_nodewithchar))
								{
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
				<h3<?php if($c==$numofrows){ ?> class="padB10"<?php $c=0; } ?>><?php echo $d_abb['title'];?><span>- <?php echo $d_abb['body_value'];?></span></h3> 
				<?php
					}
				?>
				<!--  <h3 class="padB10">4x2 <span>- Two wheel drive</span></h3> 
				<h3>A / C<span> - Air-conditioning</span></h3> 
				<h3>A.S.S<span> - After sales service</span></h3>
				<h3>ABS<span> - Anti-lock braking system</span></h3>
				<h3>AFAIK<span> - As far as I know</span></h3>
				<h3>AFR<span> - Air to Fuel Ratio</span></h3>
				<h3>API<span> - American Petroleum Institute</span></h3>
				<h3>AT <span> - Automatic transmission</span></h3>
				<h3 class="padB10">AWD<span> - All wheel drive</span></h3>
				
				<h3>BHP<span> - Brake horse power</span></h3>
				<h3>BMEP<span> - Brake mean effective pressure</span></h3>
				<h3 class="padB10">BTW<span> - By the way</span></h3>
				
				<h3>CAI <span> - Cold air induction/intake</span></h3>
				<h3>CARB <span> - Carburetor</span></h3>
				<h3>CBU <span> - Completely built unit (Import)</span></h3>
				<h3>CC <span> - Cubic capacity</span></h3>
				<h3>CNG <span> - Compressed natural gas</span></h3>
				<h3>CRDI / CDI <span> - Common rail direct injection</span></h3>
				<h3 class="padB10">CVT<span> - Continuously variable transmission</span></h3>
				
				<h3>DI<span> - Direct injection</span></h3>
				<h3 class="padB10">DOHC<span> - Double overhead camshaft</span></h3>
				
				<h3>EBD <span> - Electronic brake (force) distribution</span></h3>
				<h3>ECM <span> - Engine control module</span></h3>
				<h3>ECU <span> - Engine control unit</span></h3>
				<h3>EGT <span> - Exhaust Gas Temperature</span></h3>
				<h3>EMI <span> - Equated monthly installments </span></h3>
				<h3>EPS <span> - Electronic power steering</span></h3>
				<h3>ESC <span> - Electronic Stability Control</span></h3>
				<h3 class="padB10">ESP <span> - Electronic stability program</span></h3>
				
				<h3>FE  <span> - Fuel efficiency</span></h3>
				<h3>FFE <span> - Free flow exhaust</span></h3>
				<h3>FHP <span> - Frictional horse power</span></h3>
				<h3>FI <span> - Fuel injection</span></h3>
				<h3>FWD <span> - Front wheel drive</span></h3>
				<h3 class="padB10">FYI <span> - For your information</span></h3>
				
				<h3>GC <span> - Ground clearance</span></h3>
				<h3>GPS <span> - Global positioning system</span></h3>
				<h3 class="padB10">GVW <span> - Gross vehicle weight</span></h3>
				
				<h3>HP <span> - Horse power</span></h3>
				<h3>HSD <span> - High speed diesel</span></h3>
				<h3 class="padB10">HVAC <span> - Heating, ventilation & air-conditioning</span></h3>
				
				<h3>IAT <span> - Intake Air Temperature</span></h3>
				<h3>ICE <span> - In-Car entertainment OR Internal combustion engine</span></h3>
				<h3>IDI <span> - Indirect injection</span></h3>
				<h3>IIRC <span> - If I remember/recall correctly</span></h3>
				<h3>IMHO <span> - In my humble opinion</span></h3>
				<h3>IMO <span> - In my opinion</span></h3>
				<h3 class="padB10">ITB <span> - Individual throttle bodies</span></h3>
				
				<h3>KM <span> - Kilometers</span></h3>
				<h3>KPH <span> - Kilometers per hour</span></h3>
				<h3 class="padB10">KPL <span> - Kilometers per liter</span></h3>
				
				<h3>LCD <span> - Liquid crystal display</span></h3>
				<h3>LED <span> - Light emitting diode</span></h3>
				<h3>LHD <span> - Left hand drive</span></h3>
				<h3>LOL <span> - Laugh out loud</span></h3>
				<h3>LPG <span> - Liquid petroleum gas</span></h3>
				<h3>LSD <span> - Low Sulfur Diesel</span></h3>
				<h3 class="padB10">LWB <span> - Long wheel base</span></h3>
				
				<h3>MAF <span> - Mass air flow</span></h3>
				<h3>MHP <span> - Mental horse power (Presumed versus actual BHP)</span></h3>
				<h3>MM <span> - Millimeters</span></h3>
				<h3>MODS <span> - Modifications OR Moderators</span></h3>
				<h3>MON <span> - Motor octane number</span></h3>
				<h3>MPFI <span> - Multi-port fuel injection</span></h3>
				<h3>MPV <span> - Multi-purpose vehicle</span></h3>
				<h3>MT <span> - Manual transmission</span></h3>
				<h3 class="padB10">MUL <span> - Maruti Udyog Limited</span></h3>
				
				<h3>NA (N/A) <span> - Naturally Aspirated / Normally Aspirated</span></h3>
				<h3>NHC <span> - New Honda city</span></h3>
				<h3>NM <span> - Newton meters</span></h3>
				<h3 class="padB10">NVH <span> - Noise vibration & harshness</span></h3>
				
				<h3>O2 Sensor <span> - Oxygen sensor</span></h3>
				<h3>OBD <span> - On-board diagnostics</span></h3>
				<h3>OEM <span> - Original equipment manufacturer</span></h3>
				<h3>OHC <span> - Old Honda city OR Overhead camshaft</span></h3>
				<h3>ORVM <span> - Outside rear view mirror</span></h3>
				<h3>OT <span> - Off-topic</span></h3>
				<h3 class="padB10">OTR <span> - Off The Road</span></h3>
				
				<h3>PM <span> - Private message</span></h3>
				<h3>PS <span> - Pferdestarke (unit of power) OR Post-script</span></h3>
				<h3 class="padB10">PSI <span> - Pounds per square Inch</span></h3>
				
				<h3>RHD <span> - Right hand drive</span></h3>
				<h3>RON <span> - Research octane number (method of measuring fuel octane rating)</span></h3>
				<h3>RPM <span> - Revolution per min (also called REVs)</span></h3>
				<h3>RVM <span> - Rear view mirror</span></h3>
				<h3 class="padB10">RWD <span> - Rear wheel drive</span></h3>
				
				<h3>SC <span> - Super-charger</span></h3>
				<h3>SKD <span> - Semi-knocked down (import)</span></h3>
				<h3>SOHC <span> - Single overhead camshaft</span></h3>
				<h3>SPOA <span> - Spring Perched Over Axle</span></h3>
				<h3>SRS <span> - Supplementary restraint system</span></h3>
				<h3>SUA <span> - Spring Under Axle</span></h3>
				<h3>SUV <span> - Sports utility vehicle</span></h3>
				<h3 class="padB10">SWB <span> - Short wheel base</span></h3>
				
				<h3>TB <span> - Team-BHP! OR Throttle body</span></h3>
				<h3>TC <span> - Traction control OR Turbo-charger</span></h3>
				<h3>TD <span> - Test drive</span></h3>
				<h3 class="padB10">TPMS <span> - Tyre pressure monitoring system</span></h3>
				
				<h3 class="padB10">ULSD <span> - Ultra Low Sulfur Diesel</span></h3>
				
				<h3>VFM <span> - Value for money</span></h3>
				<h3>VGT <span> - Variable geometry turbo</span></h3>
				<h3 class="padB10">VTEC <span> - Variable valve timing and lift electronic control system</span></h3>
				
				<h3>WHP <span> - Wheel horse power</span></h3>
				<h3>WOT <span> - Wide open throttle</span></h3>
				<h3 class="padB10">WTB <span> - Want to buy</span></h3>-->
				
			</div><!-- description flow -->
			
			
		</div><!-- full news -->
		
		
	</div><!-- news deatils -->
</div><!-- tab content -->
<?php
	}
?>
