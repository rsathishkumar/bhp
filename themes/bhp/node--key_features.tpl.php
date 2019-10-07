				<?php
			//$q="SELECT n.title, mp.field_member_profile_value, kf.field_key_features_value FROM field_data_field_member_profile AS mp, field_data_field_key_features AS kf, node AS n
//WHERE n.nid = mp.entity_id AND kf.entity_id = mp.entity_id AND n.nid = kf.entity_id AND n.nid =".$node->nid;
				$q_kf="select field_key_features_value from field_data_field_key_features order by delta";
				$q_mp="select field_member_profile_value from field_data_field_member_profile order by delta";
				
				$res_kf=@mysqli_query($q_kf);
				$res_mp=@mysqli_query($q_mp);
				?>
				<div class="article">
					<h1>About Us</h1>
							
							<ul class="tab TLR5 clearfix">
								<li><a title="Overview" class="TLR5" href="/aboutus/overview">Overview</a></li>
								<li><a title="The Team" class="TLR5" href="/aboutus/team">The Team</a></li>
								<li><a title="Key Features" class="TLR5 active" href="#">Key Features</a></li>
								<li><a title="Philosophy" class="TLR5" href="/aboutus/philosophy">Our Philosophy</a></li>
								<li><a title="History" class="TLR5" href="/aboutus/history">History</a></li>								
							</ul>
						<div class="tab_container BLR5 aboutUs">
							
								<div style="display: block;" class="tab_content key_features" id="tab3">
									<h3>Key Features:</h3>
									<ul class="blackBullet marT10">
										<?php
										while($data_kf=mysql_fetch_assoc($res_kf))
											{
										?>
										<li><?php echo $data_kf['field_key_features_value'];?></li>
										<?php
											}
										?>
										
									</ul>
									<div class="page_div">&nbsp;</div>
									
									<h3>Member profile:</h3>
									<p class="marT10">We have an eclectic list of members. They:</p>
									<ul class="blackBullet marT10">
										<?php
										while($data_mp=mysql_fetch_assoc($res_mp))
											{
										?>
										<li><?php echo $data_mp['field_member_profile_value'];?></li>
										<?php
											}
										?>
									</ul>
									
									
								</div><!-- tab3 -->
							</div><!-- tab content -->
						</div>
