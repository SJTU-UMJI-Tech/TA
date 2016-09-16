    <!-- The end bar is here -->
    <div class="endbar">
        <div class="_content">
            <p>Address: 800 Dong Chuan Road,Shanghai, 200240, China</p>
            <p><a id="dept" href="http://umji.sjtu.edu.cn/cn/" target="_blank">© 2015 University of Michigan – Shanghai Jiao Tong University Joint Institute</a></p>
            <p>Server Time: &nbsp <span id="serverTime"></span>
                <script type="text/javascript">
                    // <!-- Current Time Display
                    updateFooterTime = (function() {
                        var serverTzDisplay='CST';
                        var serverServerDateAndGMTOffset = new Date(<?php echo $server_time+28800000;?>);
                        var serverLocalOffset = serverServerDateAndGMTOffset.getTime() - (new Date()).getTime();

                        return function() {
                            var offsetDate = new Date((new Date()).getTime() + serverLocalOffset);
                            var dateString = offsetDate.toUTCString()
                                .replace(/GMT/, serverTzDisplay)
                                .replace(/UTC/, serverTzDisplay);

                            document.getElementById('serverTime').innerHTML = dateString;


                            setTimeout('updateFooterTime()', 1000);
                        };
                    })();

                    updateFooterTime();
                    // -->
                </script>
            </p>
        </div>
    </div>

</div>
</body>
</html>
