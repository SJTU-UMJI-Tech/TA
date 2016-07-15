<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2 id="semester">
                    <span class="label label-info">
                        Current Semester: <?php echo $this->Mta_site->print_semester(); ?>
                    </span>
                </h2>
                <div class="attention">
                    <h2>Attention</h2>
                    <ul>
                        <li>1. For each teaching assistant, you only have two chances to do the evaluation. Please take it seriously.</li>
                        <li>2. Attention tips attention tips attention tips attention tips</li>
                        <li>3. Attention tips attention tips attention tips</li>
                    </ul>
                </div>
                <div class="talist">
                    <div class="row talist schema">
                        <h5 class="col-sm-1">Course</h5>
                        <h5 class="col-sm-2">Prof Name</h5>
                        <h5 class="col-sm-2">TA SID</h5>
                        <h5 class="col-sm-2">Name</h5>
                        <h5 class="col-sm-2">Pinyin</h5>
                        <h5 class="col-sm-1">State</h5>
                        <h5 class="col-sm-2">Process</h5>
                    </div>
                    <div class="row talist main list_container">
                        <h5 class="col-sm-1">VV233</h5>
                        <h5 class="col-sm-2">Hamade</h5>
                        <h5 class="col-sm-2">5143709233</h5>
                        <h5 class="col-sm-2">哈哈哈</h5>
                        <h5 class="col-sm-2">HaHaHa</h5>
<!--                        如果已经评教过，无论1次还是2次，以下*号显示绿色，否则显示红色-->
                        <h5 class="col-sm-1 state">*</h5>
<!--                        判断评教状态，如未评教则显示以下button，如果已评教但第二次重置次数未用完则显示Reevaluate按钮，否则显示Finished-->
                        <h5 class="col-sm-2"><button><a href="/ji_template/ta/evaluation/evaluation/evaluation.php">Evaluate</a></button></h5>
                        <br>
<!--                        先按评教状态将未评教的条目提前，之后按Course ID分组，再按Prof name分组-->


                    </div>
                </div>


            </div>
        </div>
    </div>




<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>