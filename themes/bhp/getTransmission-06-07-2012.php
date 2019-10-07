<?php
include_once("connect.php");
$eId=$_REQUEST['eId'];
$sql_fuel_type=@mysqli_fetch_array(mysqli_query("select field_engine_fuel_value from field_data_field_engine_fuel where entity_id=".$eId));
	if($sql_fuel_type['field_engine_fuel_value']=='Petrol' || $sql_fuel_type['field_engine_fuel_value']=='Diesel')
		{
		$sql_transmitiontype=@mysqli_fetch_array(mysqli_query("select field_engine_transmission_value from field_data_field_engine_transmission where entity_id=".$eId));
		if($sql_transmitiontype['field_engine_transmission_value']=='Auto')
			{
		
		$sql_ttypemannual=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_auto_value from field_data_field_engine_t_type_auto where entity_id=".$eId));
			if($sql_ttypemannual['field_engine_t_type_auto_value']!='CVT')
				{
					if($sql_ttypemannual['field_engine_t_type_auto_value']=='DSG')
						{
					$sql_ttypemannualDSG=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_dsg_value from field_data_field_engine_t_type_dsg where entity_id=".$eId));
						$val = $sql_ttypemannualDSG['field_engine_t_type_dsg_value'];
						}
						else
						{
					$sql_ttypemannualCONVENT=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_conventional_value from field_data_field_engine_t_type_conventional where entity_id=".$eId));
						$val = $sql_ttypemannualCONVENT['field_engine_t_type_conventional_value'];
						}
				}
				else
				{
			//	echo $sql_ttypemannual['field_engine_t_type_auto_value'];
				}
			
			
			}
			else
			{
		$sql_ttypemannual=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_manual_value from field_data_field_engine_t_type_manual where entity_id=".$eId));
			$val = $sql_ttypemannual['field_engine_t_type_manual_value'];
			}
		}
		else
		{
		
		$sql_otherfuel=@mysqli_fetch_array(mysqli_query("select field_engine_other_fuel_value from field_data_field_engine_other_fuel where entity_id=".$eId));
		$sql_transmitiontype=@mysqli_fetch_array(mysqli_query("select field_engine_transmission_value from field_data_field_engine_transmission where entity_id=".$eId));
		if($sql_transmitiontype['field_engine_transmission_value']=='Auto')
			{
		$sql_ttypemannual=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_auto_value from field_data_field_engine_t_type_auto where entity_id=".$eId));
			if($sql_ttypemannual['field_engine_t_type_auto_value']!='CVT')
				{
					if($sql_ttypemannual['field_engine_t_type_auto_value']=='DSG')
						{
					$sql_ttypemannualDSG=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_dsg_value from field_data_field_engine_t_type_dsg where entity_id=".$eId));
						$val = $sql_ttypemannualDSG['field_engine_t_type_dsg_value'];
						}
						else
						{
					$sql_ttypemannualCONVENT=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_conventional_value from field_data_field_engine_t_type_conventional where entity_id=".$eId));
						$val = $sql_ttypemannualCONVENT['field_engine_t_type_conventional_value'];
						}
				}
				else
				{
				//echo $sql_ttypemannual['field_engine_t_type_auto_value'];
				}
			
			
			}
			else
			{
		$sql_ttypemannual=@mysqli_fetch_array(mysqli_query("select field_engine_t_type_manual_value from field_data_field_engine_t_type_manual where entity_id=".$eId));
		$val = $sql_ttypemannual['field_engine_t_type_manual_value'];
			}
		}
if($val!="")
{
echo $val." ".$sql_transmitiontype['field_engine_transmission_value'];
}
?>
