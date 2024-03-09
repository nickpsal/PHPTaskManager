    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1><?= $data['title'] ?></h1>
                <form accept-charset="UTF-8" action="" autocomplete="on" method="POST">
                    <div class="error">
                        <?php
                        if (message()) {
                            echo message('', true);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="taskName">Task Name: </label>
                        <input type="text" class="form-control" name="taskName" placeholder="Task Name" value="<?php echo isset($data['data']) ? $data['data']->taskName : ''; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Task Desc: </label>
                        <input type="text" class="form-control" name="taskDescription" placeholder="Task Desc" value="<?php echo isset($data['data']) ? $data['data']->taskDescription : ''; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="taskSetupDate">Task Setup Date: </label>
                        <input type="Date" class="form-control" name="taskSetupDate" placeholder="Task Setup Date" value="<?php echo isset($data['data']) ? $data['data']->taskSetupDate : $data['currentDate']; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="taskScheduleDate">Task Schedule Date: </label>
                        <input type="Date" class="form-control" name="taskScheduleDate" placeholder="task Schedule Date" value="<?php echo isset($data['data']) ? $data['data']->taskScheduleDate : ''; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="taskStartTime">task Start Time: </label>
                        <input type="time" class="form-control" name="taskStartTime" placeholder="HH:MM" required value="<?php echo isset($data['data']) ? $data['data']->taskStartTime : ''; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="TaskDuration">Task Duration: </label>
                        <input type="number" class="form-control" name="TaskDuration" placeholder="Task Duration" value="<?php echo isset($data['data']) ? $data['data']->TaskDuration : ''; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="TaskEndTime">Task End Time: </label>
                        <input type="time" class="form-control" name="TaskEndTime" placeholder="Task End Time" value="<?php echo isset($data['data']) ? $data['data']->TaskEndTime : ''; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <button type="submit" value="Submit" class="btn btn-primary">OK</button>
                        <?php 
                            if (isset($data['data'])) {
                                ?>
                                    <a href="<?=URL?>home/delete?id=<?=$data['data']->Id?>" class="btn btn-primary" type="button">Return</a>
                                <?php
                            }
                        ?>
                        <a href="<?=URL?>home/" class="btn btn-primary" type="button">Return</a>
                    </div>
                </form>
            </div>
        </div>
    </div>