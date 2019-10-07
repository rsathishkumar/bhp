<script type="text/javascript">
	$(function() {
		$( "#slider" ).slider({
		range: true,
			values:[11, 50],
			min: 0,
			max: 100,
			step: 1,
			slide: function( event, ui ) {
				$( "#years" ).text(ui.value );
			}
		});
		$( "#years" ).text($( "#slider" ).slider( "value" ));
	});
	</script>
				
				
<div class="roundAll3 SearchCar cta clearfix">

	<div class="chooseCar clearfix marB10">
		<h4>Choose a Car</h4>
		<select class="marT20 marL10">
			<option>Select Make</option>
			<option>Select Make</option>
			<option>Select Make</option>
		</select>
	
		<select class="marT10 marL10 marB20">
			<option>Select Model</option>
			<option>Select Model</option>
			<option>Select Model</option>
		</select>
	</div><!-- choose car -->
	
	<div class="or">Or</div>
	
	<div class="clearfix findCar cta roundAll3 marT10">
		<h4>Find Cars by</h4>
		
		<div class="priceMeter roundAll5 marT5 pad5">

			<div class="priceSections">
				<h5>Price</h5>

				<div class="marT20 marB10">
					<div id="slider"></div>
				</div><!-- End demo -->
				
			</div>
			
			<div class="priceSections">
				<h5>Body Style</h5>
				<ul class="priceFilter clearfix">
					<li><label><input type="checkbox" name="hatchback" id="hatchback"/>Hatchback</label></li>
					<li><label><input type="checkbox" name="suv" id="suv"/>SUV</label></li>
					<li><label><input type="checkbox" name="sedan" id="sedan"/>Sedan</label></li>
					<li><label><input type="checkbox" name="muv" id="muv"/>MUV</label></li>
					<li class="last"><label><input type="checkbox" name="niche" id="niche"/>Niche</label></li>
				</ul>
			</div><!-- Body Style -->
			
			<div class="priceSections">
				<h5>Fuel Type</h5>
				<ul class="priceFilter clearfix">
					<li><label><input type="checkbox" name="petrol" id="petrol"/>Petrol</label></li>
				</ul>

				<ul class="priceFilter clearfix">
					<li class="last"><label><input type="checkbox" name="diesel" id="diesel"/>Diesel</label></li>
					<li class="last"><label><input type="checkbox" name="other" id="other"/>Other</label></li>
				</ul>
			</div><!-- Fuel Type -->
			
			<div class="priceSections">
				<h5>Transmission</h5>
				<ul class="priceFilter clearfix">
					<li class="last"><label><input type="checkbox" name="manual" id="manual"/>Manual</label></li>
					<li class="last"><label><input type="checkbox" name="automatic" id="automatic"/>Automatic</label></li>
				</ul>
			</div><!-- transmission -->
		</div><!-- price Meter box -->
		
		<div class="aln_right marT5">
			<a class="btnRight fright" href="#">
				<span>Show</span>
			</a>
			<div class="fright resultCount">25 Results</div>			
		</div>
		
	</div><!-- Find a Car -->
	
</div><!-- Choose Car CTA -->



