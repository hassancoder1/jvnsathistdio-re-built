<?php
$sql_update_viewcount = "UPDATE admin SET value = value + 1 WHERE specific_key = 'viewcount'";
$conn->query($sql_update_viewcount);
echo "views count updated successfull";
