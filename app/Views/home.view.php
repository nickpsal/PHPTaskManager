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
			<a class="a" href="<?=URL?>home"><H1 class="logo-text"><?=$data['title']?></H1></a>
			<a href="#" class="btn btn-primary" type="button">Add New</a>
			<table id="myTable" class="table table-striped">
				<div class="monthName">
					<?php
						$prev = $data['currentDate'][1] - 1;
						$next = $data['currentDate'][1] + 1;
					?>
					<a href="<?=URL?>home/show?month=<?=$prev?>" class="btn btn-primary">◄</a>
					<h3><?=$data['currentMonthName'] . " - " . $data['currentDate'][2]?></h3>
					<a href="<?=URL?>home/show?month=<?=$next?>" class="btn btn-primary">►</a>
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
									?> <a href="#" class="btn btn-primary"><?=$tasks->taskName?></a> 
								<?php }else {
									?> <a href="#" class="btn btn-primary">New Task</a> 
									<?php
								}
							}
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