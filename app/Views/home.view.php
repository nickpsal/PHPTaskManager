<!-- content -->
<section id="index-daily-prices">
    <div class="container">
        <div class="error">
		    <?php
	    	    if (message()) {
		    	    echo message('', true);
		        }
		    ?>
	    </div>
        <div class="table-responsive">
			<div class="logo-text">
				<a class="a" href="<?=URL?>/home"><?=$data['title']?></a>
			</div>
			<a href="<?=URL?>/home/add" class="btn btn-primary">New Task</a> 
			<table id="myTable" class="table table-striped">
				<div class="monthName">
					<a href="<?=URL?>/home?month=<?=$data['prev']?>" class="btn btn-primary">◄</a>
					<h3><?=$data['currentMonthName'] . " - " . $data['currentDate'][2]?></h3>
					<a href="<?=URL?>/home?month=<?=$data['next']?>" class="btn btn-primary">►</a>
				</div>
				<thead>
					<tr>
						<th>ΔΕΥΤΕΡΑ</th>
						<th>ΤΡΙΤΗ</th>
						<th>ΤΕΤΤΑΡΤΗ</th>
						<th>ΠΕΜΠΤΗ</th>
						<th>ΠΑΡΑΣΚΕΥΗ</th>
						<th>ΣΑΒΒΑΤΟ</th>
						<th>ΚΥΡΙΑΚΗ</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php
						$num_days = cal_days_in_month(CAL_GREGORIAN,  $data['currentDate'][1], $data['currentDate'][2]);    						
						$first_day = mktime(0, 0, 0, $data['currentDate'][1], 1, $data['currentDate'][2]);
						$day_of_week = date('N', $first_day);
						for ($i = 1; $i < $day_of_week; $i++) {
							echo "<td></td>";
						}
						for ($day = 1; $day <= $num_days; $day++) {
							if ($day_of_week > 7) {
								echo "</tr><tr>"; // Start a new row at the beginning of each week
								$day_of_week = 1;
							}
							echo "<td>";
							echo $day . "</br>"; // Output the day
							foreach($data['tasks'] as $tasks) {
								$date = new DateTime($tasks->taskScheduleDate);
								$taskYear = $date->format("Y");
								$taskMonth = $date->format("m");
								$taskDay = $date->format("d");
								if ($day == $taskDay && $data['currentDate'][1] == $taskMonth && $data['currentDate'][2] == $taskYear) {
									?> <a href="<?=URL?>/home/update?id=<?=$tasks->Id?>" class="btn btn-primary"><?=$tasks->taskName?></a><br/> 
								<?php }
							}
							?> 
							<?php
							echo "</td>";
							$day_of_week++;
						}
					?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section> <!-- here ends the section 'index-daily-prices' -->